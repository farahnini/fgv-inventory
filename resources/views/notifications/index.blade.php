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
                        <span>{{ __('Notification Index') }}</span>
                        <!-- Add button to clear -->
                        <form method="POST" action="{{ route('notifications.clear') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Clear All</button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table" id="inventory_items-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Messages</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifications as $notification)
                                <tr>
                                    <td>{{ $notification->created_at->format('d/m/Y') }} ({{ $notification->created_at->diffForHumans() }})</td>
                                    <td>{{ $notification->data['message'] }}</td>
                                    <!-- Mark as read -->
                                    <td>
                                        @if(!$notification->read_at)
                                            <form method="POST" action="{{ route('notifications.mark-as-read', $notification) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Mark as Read</button>
                                            </form>
                                        @else
                                            <span class="text-success">Read at {{ $notification->read_at->format('d/m/Y') }}</span>
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
@endsection