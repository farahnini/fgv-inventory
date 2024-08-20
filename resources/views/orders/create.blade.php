@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Order Details') }}</div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Order by</label>
                        <input type="text" name="name" class="form-control" value="{{ $order->user->name }}" readonly>
                    </div>
                    <div class="form-group mt-2">
                        <label for="created_at">Order at - {{$order->created_at->diffForHumans()}}</label>
                        <input name="created_at" class="form-control" value="{{ $order->created_at}}" readonly></input>
                    </div>
                    <div class="mt-4"> 
                        <table class="table" id="inventory_categories-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
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
                    <div class="form-group mt-3 text-right">
                        <a href="{{ route('home') }}" class="btn btn-secondary" style="margin-right: 4px;">Back</a>
                    </div>
                </div>
            </div>

            <div class="mt-3 form-group">
                <a href="{{route('orders.generate-pdf',$order)}}" class="btn btn-success">
                    <i class="fas fa-download mr-2"></i> Download PDF
                </a>
            </div>


            <div class="card mt-3 p-1">
                <div class="card-header">{{ __('Order Items') }}</div>

                <div class="row">
                    @foreach ($available_items as $available_item)
                    <div class="col-md-4 mb-4">
                        <form method="POST">
                            @csrf
                            <div class="card h-100">
                                <img src="{{ $available_item->image_url }}" alt="{{ $available_item->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <input type="hidden" name="item_id" value="{{ $available_item->id }}">
                                    <h5 class="card-title">{{ $available_item->name }}</h5>
                                    <p class="card-text">{{ $available_item->description }}</p>
                                    <ul class="list-unstyled">
                                        <li><strong>Weight:</strong> {{ $available_item->weight }}</li>
                                        <li><strong>Colour:</strong> {{ $available_item->colour }}</li>
                                        <li><strong>Reference Number:</strong> {{ $available_item->reference_number }}</li>
                                        <li><strong>Available Quantity:</strong> {{ $available_item->quantity }}</li>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button" onclick="decrementQuantity({{ $available_item->id }})"><b>-</b></button>
                                        </div>
                                        <input type="text" class="form-control text-center" value="1" name="quantity" id="quantity_{{ $available_item->id }}" readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" onclick="incrementQuantity({{ $available_item->id }})"><b>+</b></button>
                                        </div>
                                    </div>
                                    <button type="submit" class="form-control btn btn-primary mt-2">Order</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endforeach 
                </div>
            </div>

        <script>
            function incrementQuantity(itemId) {
                var inputElement = document.getElementById('quantity_' + itemId);
                inputElement.value = parseInt(inputElement.value) + 1;
            }

            function decrementQuantity(itemId) {
                var inputElement = document.getElementById('quantity_' + itemId);
                var currentValue = parseInt(inputElement.value);

                if (currentValue > 1) {
                    inputElement.value = currentValue - 1;
                }
            }
        </script>

        </div>
    </div>
</div>

@endsection