<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

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

    public function search(Request $request)
    {
        return view('search');
    }
}
