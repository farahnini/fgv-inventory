@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <a href="{{ route('orders.store') }}" class="btn btn-primary mb-3">Create order</a>
                    <h3>Avaliable Item(s)</h3>
                    <div class="row">
                        @foreach ($available_items as $available_item)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="{{ $available_item->image_url }}" alt="{{ $available_item->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $available_item->name }}</h5>
                                    <p class="card-text">{{ $available_item->description }}</p>
                                    <ul class="list-unstyled">
                                        <li><strong>Weight:</strong> {{ $available_item->weight }}</li>
                                        <li><strong>Colour:</strong> {{ $available_item->colour }}</li>
                                        <li><strong>Reference Number:</strong> {{ $available_item->reference_number }}</li>
                                        <li><strong>Quantity:</strong> {{ $available_item->quantity }}</li>
                                        <br>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach 
                    </div>
                    <br>
                    <h3>Order(s)</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Ordered Quantity</th>
                                <th>Available Quantity</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($available_items as $item)
                                <tr>
                                    <td><strong>{{ $item->name }}</strong></td>
                                    <td>{{ $item->orders->sum('pivot.quantity') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->quantity - $item->orders->sum('pivot.quantity') }}</td>
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
