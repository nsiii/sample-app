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
                    @if (isset($add_products))
                        @foreach($add_products as $add_product)
                            <div class="mt-2 row align-items-center justify-content-between">
                                <a id="iconLink" class="col-4" href="#">{{ $add_product['name'] }}</a>
                                <form class="col-2" action="/delete_from_cart" method="POST">
                                    @csrf
                                    <button class="btn btn-outline-secondary" type="submit">削除</button>
                                    <input type="hidden" name="product_id" value="{{ $add_product['id'] }}">
                                    <input type="hidden" name="product_name" value="{{ $add_product['name'] }}">
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
