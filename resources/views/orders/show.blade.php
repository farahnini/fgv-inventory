@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{ __('Order Details') }} - {{ strtoupper($order->order_status) }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Order By</label>
                        <input type="text" 
                            name="name" 
                            class="form-control" 
                            value="{{ $order->user->name }}" disabled
                        >
                    </div>

                    <div class="form-group">
                        <label for="name">Order At - {{ $order->created_at->diffForHumans() }}</label>
                        <input type="text" 
                            name="name" 
                            class="form-control" 
                            value="{{ $order->created_at }}" disabled
                        >
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection