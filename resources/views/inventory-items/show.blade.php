@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Show Inventory Items') }}</div>

                <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $inventory_item->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="category">Item category<span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $inventory_item->inventoryCategory->name }}" readonly>
                        </div>

                        <div class="form-group mt-2">
                            <label for="description">Description<span class="text-danger">*</span></label>
                            <textarea id="description" class="form-control" name="description" value="{{ $inventory_item->description }}" readonly></textarea>
                        </div>

                        <div class="form-group mt-2">
                            <label for="weight">Weight (kg)<span class="text-danger">*</span></label>
                            <input id="weight" type="number" step="0.01" class="form-control" name="weight" value="{{ $inventory_item->weight }}" readonly>
                        </div>

                        <div class="form-group mt-2">
                            <label for="colour">Colour</label>
                            <input id="colour" type="text" class="form-control" name="colour" value="{{ $inventory_item->colour }}" readonly>
                        </div>

                        <div class="form-group mt-2">
                            <label for="reference_number">Reference number</label>
                            <input id="reference_number" type="text" class="form-control" name="reference_number" value="{{ $inventory_item->reference_number }}" readonly>
                        </div>

                        <div class="form-group mt-2">
                            <label for="quantity">Quantity<span class="text-danger">*</span></label>
                            <input id="quantity" type="number" class="form-control" name="quantity" value="{{ $inventory_item->quantity }}" readonly>
                        </div>
                        <div class="form-group mt-2">
                            <label for="image">Image</label>
                        </div>
                        <div class="form-group mt-2">
                            <img id="preview" src="{{ $inventory_item->image_url }}" alt="{{ $inventory_item->image_url }}" class="mt-3" style="max-height: 200px;">
                        </div>
                        <div class="form-group mt-3 text-right">
                            <a href="{{ route('inventory-items.index') }}" class="btn btn-secondary" style="margin-right: 4px;">Back</a>
                            <a href="{{ route('inventory-items.edit', $inventory_item->id) }}" class="btn btn-warning" style="margin-right: 4px;">Update</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection