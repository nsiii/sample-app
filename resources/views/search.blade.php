@extends('layouts.category')

@section('card_right')
<div class="card-header">"{{ $keyword }}"の検索結果: {{ $count }}件</div>
                
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row row-cols-3">
        @foreach ($matches as $match)
            <form class="col" method="GET" action="{{ route('product') }}">
                <input type="hidden" name="product_id" value="{{ $match['product_id'] }}">
                <button type="submit" class="btn btn-link ratio ratio-1x1">
                    <img id="objectFit" src="{{ '/storage/' . $match['thumbnail_img'] }}" class="mb-3 img-fluid">
                </button>
                <h5>{{ $match['product_name'] }}</h5>
                <p>¥{{ number_format($match['price']) }}</p>
            </form>
        @endforeach
    </div>
</div>
@endsection
