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
            <form method="POST" action="{{ route('product',['id' => $match['product_id']]) }}">
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
@endsection
