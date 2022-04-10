@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">{{ __('商品画像') }}</div>
                <div class="card-body row justify-content-center">
                    <img src="{{ '/storage/' . $images[0]['name'] }}" id="mainImage" width="400px">
                    <ul id="imageList" class="mt-5 row">
                        @foreach ($images as $image)
                            <li class="col-3 imgList">
                                <img src="{{ '/storage/' . $image['name'] }}" class="w-100 mb-3" onclick="clickChangeImage(this.src)"/>
                            </li>
                        @endforeach
                    </ul>
                    <script>
                        // クリックした画像に切り替える
                        function clickChangeImage(src) {
                            const mainImageElement = document.getElementById('mainImage');
                            mainImageElement.setAttribute('src', src);
                        }
                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">{{ __('商品概要') }}</div>
                <div class="card-body">
                    <p>{{ $product_detail['name'] }}</p>
                    <p>¥{{ $product_detail['price'] }}税込</p>
                    @if ($product_detail['stock'] > 0)
                        <p>在庫あり</p>
                    @else
                        <p>在庫なし</p>
                    @endif
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
