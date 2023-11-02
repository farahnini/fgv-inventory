@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inventory Item') }}</div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Inventory Categories</label>
                            <select class="form-select" name="category_id">
                                @foreach($inventory_categories as $inventory_category)
                                    <option value="{{ $inventory_category->id }}">
                                        {{ $inventory_category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="description">Description<span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" placeholder="Enter description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="name">Weight<span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="weight" class="form-control" placeholder="Enter Weight" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Quantity<span class="text-danger">*</span></label>
                            <input type="number" name="quantity" class="form-control" placeholder="Enter quantity" required>
                        </div>
                    
                
                        <div class="form-group mt-3 text-right">
                            <a href="{{ route('inventory-categories.index') }}" class="btn btn-secondary" style="margin-right: 4px;">Back</a>
                            <button type="reset" class="btn btn-warning" style="margin-right:4px;">Reset</button>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('imageInput');
        const preview = document.getElementById('preview');
        const resetButton = document.querySelector('button[type="reset"]');

        imageInput.addEventListener('change', evt => {
            const [file] = imageInput.files;
            if (file) {
                preview.style.display = 'block';
                preview.src = URL.createObjectURL(file);
            } else {
                preview.style.display = 'none';
            }
        });

        resetButton.addEventListener('click', function () {
            // Clear the image preview when the reset button is clicked
            preview.style.display = 'none';
            preview.src = '';
        });
    });
</script>


@endsection