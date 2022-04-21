@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-body row justify-content-center">
                    @if (is_array($images))
                        <img src="{{ '/storage/' . $images[0]['name'] }}" id="mainImage" width="400px">
                        <ul class="mt-5 row">
                            @foreach ($images as $image)
                                <li class="col-3 imgList">
                                    <img src="{{ '/storage/' . $image['name'] }}" class="w-100 mb-3" onclick="clickChangeImage(this.src)"/>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>{{ $images }}</p>
                    @endif
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
                <div class="card-body">
                    <h3 class="border-bottom">{{ $product_detail['name'] }}</h3>
                    <div class="list-group list-group-horizontal">
                        @if (is_array($categories))
                            @foreach ($categories as $category)
                                <a href="#" class="pe-2" style="font-size: 0.8em">- {{ $category['category_name'] }}</a href="">
                            @endforeach
                        @else
                            <p>- {{ $categories }}</p>
                        @endif
                    </div>
                    <p style="text-decoration: line-through">¥{{ number_format($product_detail['price']) }} 税込</p>
                    <h4 style="color:red">¥{{ number_format($product_detail['price'] * 0.7) }} 税込</h4>
                    @if ($product_detail['stock'] > 0)
                        <p>在庫あり</p>
                        <form class="input-group" action="{{ route('add_to_cart') }}" method="POST">
                            @csrf
                            <button type="submit" class="ms-2 px-3 btn btn-outline-secondary rounded-pill"><i class="me-2" data-feather="shopping-cart"></i>カートに入れる</button>
                            <button type="submit" class="ms-2 px-5 btn btn-outline-secondary rounded-pill">今すぐ買う</button>
                            <input type="hidden" name="product_id" value="{{ $product_detail['id'] }}">
                            <input type="hidden" name="product_price" value="{{ $product_detail['price'] }}">
                        </form>
                        @else
                        <p>SOLD OUT</p>
                        <div class="input-group"> 
                            <p style="color:red">次回の入荷をお待ちください。</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @foreach ($product_contents as $product_content)
            <div class="mt-4">
                <div class="card">
                    <div class="card-body">
                            <h3 class="pb-2 border-bottom ">説明</h3>
                            <p>
                                {{ $product_content['content'] }}
                            </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
