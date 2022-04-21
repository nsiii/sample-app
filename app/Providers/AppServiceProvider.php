<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ProductCategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        // クロージャベースのコンポーザを使用
        view()->composer('*', function ($view) {
            $user = \Auth::user();
            $product_categories = ProductCategory::get(['id','name']);
            $view->with('user', $user)->with('product_categories', $product_categories);
        });
    }
}
