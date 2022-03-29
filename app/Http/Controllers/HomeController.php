<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;

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
}
