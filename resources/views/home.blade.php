@extends('layouts.category')

@section('content')
<div class="card-header">{{ __('Products') }}</div>

<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    {{ __('You are logged in!') }}
</div>
@endsection
