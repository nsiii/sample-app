@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-2 col-md-3">
            <div class="card">
                <div class="card-header">{{ __('Category') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($product_categories as $product_category)
                        <a href="#">{{ $product_category['name'] }}<i data-feather="chevron-right"></i></a>
                    @endforeach
                </div>
            </div>
        </div>
                
        <div class="col-lg-10 col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Products') }}</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row row-cols-3">
                        @foreach ($matches as $match)
                            <form method="POST" action="/product_detail">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $match['product_id'] }}">
                                <button type="submit" class="col btn btn-link">
                                    <img src="{{ '/storage/' . $match['thumbnail_img'] }}" class="mb-3 img-thumbnail">
                                    <p>{{ $match['product_name'] }}</p>
                                    <p>¥{{ number_format($match['price']) }}</p>
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
