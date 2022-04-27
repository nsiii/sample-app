@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
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
                                <form method="GET" action="{{ route('search') }}">
                                    <input type="hidden" name="category_id" value="{{ $product_category['id'] }}">
                                    <input type="hidden" name="category_name" value="{{ $product_category['name'] }}">
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