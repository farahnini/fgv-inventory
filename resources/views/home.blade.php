@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Available Items') }}</div>

                <div class="card-body">
                   @foreach($available_items as $item)
                        {{ $item->name }} - {{ $item->orders->sum('pivot.quantity') }}/{{ $item->quantity }} | Balance: {{ $item->quantity -  $item->orders->sum('pivot.quantity')}} <br>
                   @endforeach
                   <a href="{{ route('orders.store') }}" class="btn btn-primary">Create Order Now</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
