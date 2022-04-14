<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Image;
use App\Models\ProductDetail;
use App\Lib\MyFunc;
use App\Models\ProductProductCategory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        return view('home');
    }
    
    // この中でやりたい処理は、検索キーワードに一致する商品をビューに表示する
    public function search_result(Request $request)
    {
        // postでcategory_idが送信されたときとそうでない時で分岐
        $category_id = $request->input('category_id');
        $keyword = $request->input('keyword');
        if (empty($category_id)) {
            // キーワードと一致するものを取得する
            $matches = Product::join('images', 'products.id', '=', 'images.product_id')
            ->where('products.name','LIKE', "%$keyword%")
            ->select('products.id as product_id','products.name as product_name', 'price', 'stock', 'images.id as img_id', 'images.name as thumbnail_img')
            ->get();
        } else {
            // $category_idを持っている商品を画像と共に取得する
            $matches = Product::join('product_product_categories', 'products.id', '=', 'product_product_categories.product_id')
            ->join('images', 'products.id', '=', 'images.product_id')
            ->where('product_category_id', $category_id)
            ->select('product_category_id', 'products.id as product_id', 'products.name as product_name', 'price', 'stock', 'images.id as img_id', 'images.name as thumbnail_img')
            ->get();
        }

        $matches = MyFunc::getUniqueArray($matches, 'product_id');
        $count = count($matches);
        return view('search', compact('matches', 'count'));
    }


    // 商品IDを取得して、詳しい商品の情報を返す。
    public function product_detail(Request $request)
    {  
        // 商品IDを取得
        $product_id = $request->input('product_id');
        // 取得した商品IDでID検索し、そのレコードを取得
        $product_detail = Product::where('id', $product_id)->first();
        $categories = ProductProductCategory::join('product_categories', 'product_category_id', '=', 'product_categories.id')
        ->where('product_product_categories.product_id', $product_id)
        ->select('name as category_name')
        ->get()->all();
        $images = Image::where('product_id', $product_id)->get()->all();
        $product_contents = ProductDetail::where('product_id', $product_id)->get();
        $images = MyFunc::confirmEmptyArray($images, '画像がありません');
        $categories = MyFunc::confirmEmptyArray($categories, 'カテゴリがありません');

        return view('product_detail', compact('product_detail', 'images', 'product_contents', 'categories'));
    }


    public function cart()
    {   
        // ユーザー情報の取得
        $user = \Auth::user();
    
        // ログインしているユーザーのカートの中身と関連の商品情報を取得
        $carts_join_products = Cart::where('user_id', $user['id'])->join('products', 'carts.product_id', '=', 'products.id')->get()->all();
        
        // カートが空の場合、メッセージを出す
        $carts_join_products = MyFunc::confirmEmptyArray($carts_join_products, 'カートの中身は空です。');
        return view('cart', compact('carts_join_products'));
    }
    
    public function add_to_cart(Request $request)
    {   
        // ユーザー情報の取得
        $user = \Auth::user();
        // 商品情報を取得
        $product_id = $request->input('product_id');
        $product_price = $request->input('product_price');

        // 既にカートに入れた商品かどうか判別する
        $already_exist = Cart::where('user_id', $user['id'])->where('product_id', $product_id)->first();
        
        // 同じproduct_idが既にカート内にある時、quantityの値を+1する
        if (empty($already_exist)) {
            // ユーザーIDをcartテーブルに登録し、cart_idを取得
            $cart_id = Cart::insertGetId([
                'user_id' => $user['id'],
                'product_id' => $product_id,
                'quantity' => 1,
                'price' => $product_price
            ]);
        } else {
            // ユーザー認証
            $i = Cart::where('user_id', $user['id'])->where('product_id', $product_id);
            // 存在しているレコードの中からquantityカラムを取得
            $quantity = $i->first('quantity');
            $quantity['quantity'] += 1;
            $price = $i->first('price');
            $price['price'] += $product_price;

            $i->update([
                'quantity' => $quantity['quantity'],
                'price' => $price['price']
            ]);
        }
        
        return redirect()->route('cart');
    }

    public function delete_from_cart(Request $request)
    {   

        // ユーザー情報の取得
        $user = \Auth::user();
        // 商品IDを取得
        $product_id = $request->input('product_id');
        $product_name = $request->input('product_name');
        // 押した削除ボタンの商品IDと一致するレコードを取得
        $delete_records = Cart::where('user_id', $user['id'])->where('product_id', $product_id)->get();
        foreach ($delete_records as $delete_record) {
            $delete_record->delete();
        }
        
        return redirect()->route('cart')->with('success', "{$product_name}をカートから削除しました!");
    }

    public function purchase(Request $request)
    {   
        // ユーザー情報の取得
        $user = \Auth::user();
        // 商品IDを取得
        $product_id = $request->input('product_id');
        $product_name = $request->input('product_name');
        // 押した削除ボタンの商品IDと一致するレコードを取得
        $delete_records = Cart::where('user_id', $user['id'])->where('product_id', $product_id)->get();
        foreach ($delete_records as $delete_record) {
            $delete_record->delete();
        }
        
        return redirect()->route('cart')->with('success', "{$product_name}をカートから削除しました!");
    }
}
