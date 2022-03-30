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
        // カテゴリ名の取得
        $product_categories = ProductCategory::get(['id','name']);
        // dd($product_categories);
        return view('home', compact('product_categories'));
    }
    
    public function search()
    {   
        // カテゴリ名の取得
        $product_categories = ProductCategory::get(['id','name']);
        // dd($product_categories);
        return view('search', compact('product_categories'));
    }
    
    // この中でやりたい処理は、検索キーワードに一致する商品をビューに表示する
    public function search_result(Request $request)
    {
        $product_categories = ProductCategory::get(['id','name']);
        $keyword = $request->input('keyword');
        // // 検索ワードと一致するものを取得する
        $matches = Product::where('name','LIKE', '%'.$keyword.'%')->get();
        // dd($matches);
        
        return view('search', compact('product_categories','matches'));
    }


    // 商品IDを取得して、詳しい商品の情報を返す。
    public function product_detail(Request $request)
    {   
        // カテゴリ名の取得
        $product_categories = ProductCategory::get(['id','name']);
        
        // 商品IDを取得
        $product_id = $request->input('product_id');
        // 取得した商品IDでID検索し、そのレコードを取得
        $product_detail = Product::where('id', $product_id)->first();
        // dd($product_detail);

        return view('product_detail', compact('product_categories', 'product_detail'));
    }


    public function cart()
    {   
        // カテゴリ名の取得
        $product_categories = ProductCategory::get(['id','name']);
        
        // ユーザー情報の取得
        $user = \Auth::user();
        
        // ログインしているユーザーのカートの中身を取得
        $carts = Cart::where('user_id', $user['id'])->get();
        // そのカートに入れている商品名を配列に格納
        foreach ($carts as $cart) {
            $add_products[] = Product::where('id', $cart['product_id'])->first();
        }
        return view('cart', compact('user','product_categories', 'add_products'));
    }
    
    public function add_to_cart(Request $request)
    {   
        // カテゴリ名の取得
        $product_categories = ProductCategory::get(['id','name']);
        
        // ユーザー情報の取得
        $user = \Auth::user();
        // 商品情報を取得
        $product_id = $request->input('product_id');
        $product_price = $request->input('product_price');
        
        // ユーザーIDをcartテーブルに登録し、cart_idを取得
        $cart_id = Cart::insertGetId([
            'user_id' => $user['id'],
            'product_id' => $product_id,
            'quantity' => 1,
            'price' => $product_price
        ]);

        return redirect()->route('cart')->with(compact('product_categories'));

    }
}
