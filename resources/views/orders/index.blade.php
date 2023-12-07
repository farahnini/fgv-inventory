@extends('layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>{{ __('Orders Index') }}</span>
                        <a href="{{ route('orders.store') }}" class="btn btn-primary">+ Order</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                       <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Ordered by</th>
                                    <th>Ordered date</th>
                                    <th>Item</th>
                                    <th class="text-center">Sum items ordered</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                @if ($order->inventoryItems->count() >= 1)
                                    <tr>
                                        <td rowspan="{{ $order->inventoryItems->count() }}">{{ $order->id }}</td>
                                        <td rowspan="{{ $order->inventoryItems->count() }}">{{ $order->user->name }}</td>
                                        <td rowspan="{{ $order->inventoryItems->count() }}">{{ $order->created_at }}</td>
                                        @php $first = true; @endphp
                                        @foreach ($order->inventoryItems as $item)
                                            @if (!$first)
                                                <tr>
                                                    @endif
                                                    <td>{{ $item->name }}</td>
                                                    <td class="text-center">{{ $item->pivot->quantity }}</td>
                                                    @if ($first)
                                                </tr>
                                                @php $first = false; @endphp
                                            @endif
                                        @endforeach
                                    </tr>
                                @endif
                            @endforeach

                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection