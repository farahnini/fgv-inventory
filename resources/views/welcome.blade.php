@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3 p-1">
                <div class="card-header">{{ __('Available Products') }}</div>

                <div class="row">
                    @foreach ($available_items as $available_item)
                    <div class="col-md-4 mb-4">
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
                                <form method="POST" action="{{ route('carts.add', $available_item) }}">
                                    @csrf
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button" onclick="decrementQuantity({{ $available_item->id }})"><b>-</b></button>
                                        </div>
                                        <input type="text" class="form-control text-center" value="1" name="quantity" id="quantity_{{ $available_item->id }}" readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" onclick="incrementQuantity({{ $available_item->id }})"><b>+</b></button>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2 form-control">+ Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach 
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @if(count($cart_products) > 0)
                <div class="card mt-3 p-1">
                    <div class="card-header">{{ __('Products On My Cart') }} <a href="{{ route('carts.clear') }}">Clear Cart</a></div>
                    <div class="row">
                        @foreach ($cart_products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product['name'] }} x {{ $product['quantity'] }}</h5>
                                </div>  
                            </div>
                        </div>
                        @endforeach 
                    </div>
                    <h1>Total Item: {{ $cart_total}} </h1>
                </div>
            @endif
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