@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">{{ __('商品画像') }}</div>
                <div class="card-body">
                    @foreach($add_products as $add_product)
                        <div class="row align-items-center justify-content-between">
                            <a id="iconLink" class="col-4" href="#">{{ $add_product['name'] }}</a>
                            <form class="col-2" action="/delete_from_cart" method="POST">
                                @csrf
                                <button class="btn btn-outline-secondary" type="submit">削除</button>
                                <input type="hidden" name="product_id" value="{{ $add_product['id'] }}">
                            </form>
                        </div>
                    @endforeach
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
