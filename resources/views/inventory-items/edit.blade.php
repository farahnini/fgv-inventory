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
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Create Inventory Items') }}</div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $inventory_item->name }}" placeholder="Enter your name" required>
                            <small class="form-text text-muted">e.g., Fire extinguisher</small>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category">Item category<span class="text-danger">*</span></label>
                            <select name="category_id"  class="form-control" required>
                                @foreach ($inventory_categories as $inventory_category)
                                    <option value="{{ $inventory_category->id }}">{{ $inventory_category->name }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">e.g., Select Item Category</small>
                        </div>

                        <div class="form-group mt-2">
                            <label for="description">Description<span class="text-danger">*</span></label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $inventory_item->description }}"  placeholder="Enter Description" required></textarea>
                            <small class="form-text text-muted">e.g., Kebakaran</small>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="weight">Weight (kg)<span class="text-danger">*</span></label>
                            <input id="weight" type="number" step="0.01" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ $inventory_item->weight }}" placeholder="Enter weight" required>
                            <small class="form-text text-muted">e.g., 8.21</small>
                            @error('weight')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="colour">Colour</label>
                            <input id="colour" type="text" class="form-control @error('colour') is-invalid @enderror" name="colour" value="{{ $inventory_item->colour }}" placeholder="Enter Colour">
                            <small class="form-text text-muted">e.g., Purple</small>
                            @error('colour')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="reference_number">Reference number</label>
                            <input id="reference_number" type="text" class="form-control @error('reference_number') is-invalid @enderror" name="reference_number" value="{{ $inventory_item->reference_number }}" placeholder="Enter reference number">
                            <small class="form-text text-muted">e.g., A12321</small>
                            @error('reference_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="quantity">Quantity<span class="text-danger">*</span></label>
                            <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ $inventory_item->quantity }}" placeholder="Enter quantity" required>
                            <small class="form-text text-muted">e.g., 3</small>
                            @error('quantity')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="imageInput" class="form-control">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <img id="preview" src="{{ $inventory_item->image_url }}" alt="{{ $inventory_item->image_url }}" class="mt-3" style="max-height: 200px;">
                        </div>
                        <div class="form-group mt-3 text-right">
                            <a href="{{ route('inventory-items.index') }}" class="btn btn-secondary" style="margin-right: 4px;">Back</a>
                            <button type="reset" class="btn btn-warning" style="margin-right:4px;">Reset</button>
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