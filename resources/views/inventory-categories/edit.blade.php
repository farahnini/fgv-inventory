@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.getElementById('imageInput').addEventListener('change', function (e) {
        var file = e.target.files[0];
        if (file) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = document.getElementById('previewImage');
                img.src = e.target.result;
                img.style.display = 'block';
            };

            reader.readAsDataURL(file);
        }
    });
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inventory Category') }}</div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name" value="{{ $inventory_category->name }}" required>
                            <small class="form-text text-muted">e.g., Safety</small>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="description">Description<span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" placeholder="Enter description" value="{{ $inventory_category->description }}" required></textarea>
                            <small class="form-text text-muted">e.g., Safety-related category</small>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="imageInput" class="form-control">
                            <p>Current Image: {{ $inventory_category->image }}</p>
                        </div>
                        <div class="form-group mt-2">
                            <img id="preview" src="{{ asset('images/' . $inventory_category->image) }}" class="mt-3" style="max-height: 200px;">
                        </div>
                        <div class="form-group mt-3 text-right">
                            <a href="{{ route('inventory-categories.index') }}" class="btn btn-secondary" style="margin-right: 4px;">Back</a>
                            <button type="reset" class="btn btn-warning" style="margin-right: 4px;">Reset</button>
                            <button type="submit" class="btn btn-primary">Update</button>
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