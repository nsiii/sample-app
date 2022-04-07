@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">{{ __('ショッピングカート') }}</div>
                <div class="card-body">
                    <!-- $carts_join_productsが定義されていれば、true -->
                    @if (isset($carts_join_products))
                    @foreach($carts_join_products as $cart_join_product)
                    <div class="mt-2 row align-items-center justify-content-between">
                        <form class="col input-group" method="POST" action="/product_detail">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $cart_join_product['product_id'] }}">
                            <button type="submit" class="btn btn-link">
                                {{ $cart_join_product['name'] }}
                            </button>
                        </form>
                        <form class="col input-group" action="/add_to_cart" method="POST">
                            <a id="iconLink" class="me-2" href="#">
                                {{ $cart_join_product['quantity'] }}
                            </a>
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
                            <input type="hidden" name="product_id" value="{{ $cart_join_product['product_id'] }}">
                            <input type="hidden" name="product_price" value="{{ $cart_join_product['price'] }}">
                        </form>
                        <form class="col input-group" action="/delete_from_cart" method="POST">
                            @csrf
                            <button class="btn btn-outline-secondary" type="submit">削除</button>
                            <input type="hidden" name="product_id" value="{{ $cart_join_product['id'] }}">
                            <input type="hidden" name="product_name" value="{{ $cart_join_product['name'] }}">
                        </form>
                    </div>
                    @endforeach
                    @else
                    {{ $empty_cart }}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('商品概要') }}</div>
                <div class="card-body">
                    <p>{{ config('database.default') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection