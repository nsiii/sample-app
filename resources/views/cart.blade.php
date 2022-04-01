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
                    <!-- $add_productが定義されていれば、true -->
                    @if (isset($carts_join_products))
                        @foreach($carts_join_products as $cart_join_product)
                            <div class="mt-2 row align-items-center justify-content-between">
                                <a id="iconLink" class="col-5" href="#">{{ $cart_join_product['name'] }}</a>
                                <a id="iconLink" class="col-2" href="#">
                                    <form class="input-group" action="/add_to_cart" method="POST">
                                        @csrf
                                        {{ $cart_join_product['quantity'] }}
                                        <button type="submit" class="ms-2 btn btn-outline-secondary btn-sm">+</button>
                                        <input type="hidden" name="product_id" value="{{ $cart_join_product['product_id'] }}">
                                        <input type="hidden" name="product_price" value="{{ $cart_join_product['price'] }}">
                                    </form>
                                </a>
                                <form class="col-2" action="/delete_from_cart" method="POST">
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
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection
