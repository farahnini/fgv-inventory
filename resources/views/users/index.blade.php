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
                    columns: [0, 1, 2, 3, 4],
                },
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4],
                },
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4],
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4],
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
                        <span>{{ __('Users Index') }}</span>
                        @can('user-create')
                            <a href="{{ route('users.create') }}" class="btn btn-primary">+ User</a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="users-table" class="display">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th>Role</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td style="white-space: nowrap;">{{ $user->name }}</td>
                                        <td style="white-space: nowrap;">{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->roles->implode('name', ', ') }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td style="white-space: nowrap;">
                                            <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-primary" style="margin-right:2px;">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @can('user-edit')
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-success" style="margin-right:2px;">
                                                <i class="fas fa-edit"></i> 
                                            </a>
                                            @endcan
                                            @can('user-delete')
                                            <a href="{{ route('users.delete', $user) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            @endcan
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