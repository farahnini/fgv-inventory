@extends('layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function () {
    $('#inventory_categories-table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2],
                },
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2],
                },
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2],
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2],
                },
            },
        ],
    });
});


</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>{{ __('Inventory Category Index') }}</span>
                        <a href="{{ route('inventory-categories.create') }}" class="btn btn-primary">+ Category</a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table" id="inventory_categories-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventory_categories as $inventory_category)
                                <tr>
                                    <td>{{ $inventory_category->name }}</td>
                                    <td>{{ $inventory_category->description }}</td>
                                    <td>
                                        @if($inventory_category->image)
                                            <img src="{{ asset('images/' . $inventory_category->image) }}" alt="{{ $inventory_category->name }}" width="100">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>{{ $inventory_category->created_at }}</td>
                                    <td>{{ $inventory_category->updated_at }}</td>
                                    <td style="white-space: nowrap;">
                                        <a href="{{ route('inventory-categories.show', $inventory_category->id) }}" class="btn btn-sm btn-primary" style="margin-right:2px;">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('inventory-categories.edit', $inventory_category->id) }}" class="btn btn-sm btn-success" style="margin-right:2px;">
                                            <i class="fas fa-edit"></i> 
                                        </a>
                                        <a href="{{ route('inventory-categories.delete', $inventory_category->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
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