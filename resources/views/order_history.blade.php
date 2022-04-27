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
