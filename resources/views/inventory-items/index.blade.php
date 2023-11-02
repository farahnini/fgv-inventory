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
    $('#inventory_items-table').DataTable({
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
                    columns: [0, 1, 4],
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 4],
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
                        <span>{{ __('Inventory Items Index') }}</span>
                        <a href="{{ route('inventory-items.create') }}" class="btn btn-primary">+ Items</a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table" id="inventory_items-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventory_items as $inventory_item)
                                <tr>
                                    <td>{{ $inventory_item->name }}</td>
                                    <td>{{ $inventory_item->description }}</td>
                                    <td>{{ $inventory_item->inventoryCategory->name }}</td>
                                    <td>
                                        <img src="{{ $inventory_item->image_url }}" height="100">
                                    </td>
                                    <td>{{ $inventory_item->created_at }}</td>
                                    <td>{{ $inventory_item->updated_at }}</td>
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