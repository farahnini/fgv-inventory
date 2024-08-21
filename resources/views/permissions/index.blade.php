
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
        $('#users-table').DataTable({
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
                        <span>{{ __('Permissions Index') }}</span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="users-table" class="display">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td style="white-space: nowrap;">{{ $permission->name }}</td>
                                        <td>
                                            @if($permission->roles->isNotEmpty())
                                                {{ $permission->roles->pluck('name')->implode(', ') }}
                                            @else
                                                No Roles Assigned
                                            @endif
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
</div>

@endsection