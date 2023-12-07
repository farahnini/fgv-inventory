@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inventory Category') }}</div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $inventory_category->name }}" readonly>
                        </div>
                        <div class="form-group mt-2">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" value="{{ $inventory_category->description }}" readonly>{{ $inventory_category->description }}</textarea>
                        </div>
                        <div class="form-group mt-2">
                            <label for="image">Image</label>
                            <input type="text" name="name" class="form-control"  value="{{ $inventory_category->image }}" readonly>

                        </div>
                        <div class="form-group mt-2">
                            <img id="preview" src="{{ asset('images/' . $inventory_category->image) }}" class="mt-3" style="max-height: 200px;">
                        </div>
                         <div class="form-group mt-3 text-right">
                            <a href="{{ route('inventory-categories.index') }}" class="btn btn-secondary" style="margin-right: 4px;">Back</a>
                            <a href="{{ route('inventory-categories.edit', $inventory_category->id) }}" class="btn btn-warning" style="margin-right: 4px;">Update</a>
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
        const resetButton = document.querySelector('button[type="reset']');

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