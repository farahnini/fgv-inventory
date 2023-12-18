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
                    <br>
                    <div class="form-group">
                        <a href="{{ route('orders.generate-pdf', $order) }}" class="btn btn-success">Download PDF</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{ __('Available Items') }}
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Inventory Item</label>
                            <select class="form-select" name="item_id">
                                @foreach($available_items as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Quantity</label>
                            <input type="number" name="quantity" class="form-control" value="1">
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">+ Add To My Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Order Item') }}
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item Name</th>   
                                <th>Item Ordered Quantity</th>               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->inventoryItems as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->pivot->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        
    </div>
</div>

@endsection