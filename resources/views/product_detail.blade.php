@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">{{ __('商品画像') }}</div>
                <div class="card-body">
                    @foreach ($images as $image)
                        <img src="{{ '/storage/' . $image['name'] }}" class="w-100 mb-3" onclick="clickDisplayAlert()"/>
                    @endforeach
                    <script>
                        function clickDisplayAlert() {
                        alert("ボタンがクリックされました！");
                        }
                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('商品概要') }}</div>
                <div class="card-body">
                    <p>{{ $product_detail['name'] }}</p>
                    <button type="button" class="btn btn-outline-primary">今すぐ買う</button>
                    <form class="input-group" action="/add_to_cart" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary"><i class="me-2" data-feather="shopping-cart"></i>カートに入れる</button>
                        <input type="hidden" name="product_id" value="{{ $product_detail['id'] }}">
                        <input type="hidden" name="product_price" value="{{ $product_detail['price'] }}">
                    </form>
                </div>
            </div>
        </div>

        @foreach ($product_contents as $product_content)
            <div class="mt-5">
                <div class="card">
                    <div class="card-header">{{ __('商品説明') }}</div>
                    <div class="card-body">
                            {{ $product_content['content'] }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
