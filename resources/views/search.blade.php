@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">{{ __('Category') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($product_categories as $product_category)
                        <a id="iconLink" href="#">{{ $product_category['name'] }}<i data-feather="chevron-right"></i></a>
                    @endforeach
                </div>
            </div>
        </div>
                
        <div class="col-md-10">
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
                            <a id="iconLink" class="col" href="#">
                                <p>名前: {{ $match['name'] }}</p>
                                <p>金額: {{ $match['price'] }}円</p>
                                <p>在庫: {{ $match['stock'] }}個</p>    
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
