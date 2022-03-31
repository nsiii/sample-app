<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Cart;


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
        $keyword = $request->input('keyword');
        // // 検索ワードと一致するものを取得する
        $matches = Product::where('name','LIKE', '%'.$keyword.'%')->get();
        
        return view('search', compact('matches'));
    }


    // 商品IDを取得して、詳しい商品の情報を返す。
    public function product_detail(Request $request)
    {  
        // 商品IDを取得
        $product_id = $request->input('product_id');
        // 取得した商品IDでID検索し、そのレコードを取得
        $product_detail = Product::where('id', $product_id)->first();

        return view('product_detail', compact('product_detail'));
    }


    public function cart()
    {   
        // ユーザー情報の取得
        $user = \Auth::user();
        
        // ログインしているユーザーのカートの中身と関連の商品情報を取得
        $carts_join_products = Cart::where('user_id', $user['id'])->join('products', 'carts.product_id', '=', 'products.id')->get()->all();
        
        // カートが空の場合、メッセージを出す
        if (empty($carts_join_products)) {
            $empty_cart = "カートの中身は空です。";
            return view('cart', compact('user', 'empty_cart'));
        } else {
            return view('cart', compact('user', 'carts_join_products'));
        }
    }
    
    public function add_to_cart(Request $request)
    {   
        // ユーザー情報の取得
        $user = \Auth::user();
        // 商品情報を取得
        $product_id = $request->input('product_id');
        $product_price = $request->input('product_price');
        // 既にカートに入れた商品かどうか判別する
        $already_exist = Cart::where('product_id', $product_id)->first();
        
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
            $i = Cart::where('product_id', $product_id);
            // 存在しているレコードの中からquantityカラムを取得
            $quantity = $i->first('quantity');
            $quantity['quantity'] += 1;
            $i->update(['quantity' => $quantity['quantity'] ]);
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
