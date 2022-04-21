@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-2 col-md-3">
                <div class="card">
                    <div class="card-header">カテゴリ</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            @foreach($product_categories as $product_category)
                                <form method="POST" action="{{ route('search', ['category' => $product_category['name']]) }}">
                                    @csrf
                                    <input type="hidden" name="category_id" value="{{ $product_category['id'] }}">
                                    <button type="submit" class="col btn btn-link">{{ $product_category['name'] }}<i data-feather="chevron-right"></i></button>
                                </form>
                            @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-10 col-md-9">
                <div class="card">
                    @yield('card_right')
                </div>
            </div>
        </div>
    </div>
@endsection