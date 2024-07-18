@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>{{ __('My Notification') }}</span>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table" id="inventory_items-table">
                        <thead>
                            <tr>
                                <th>Message</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifications as $notification)
                                <tr>
                                    <td>{{ $notification->data['message'] }}</td>
                                    <td>{{ $notification->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if($notification->read_at == null)
                                            <a href="{{ route('notifications.mark-as-read', $notification) }}" class="btn btn-primary">Mark As Read</a>
                                        @else
                                            <a href="" class="btn btn-light">Read at {{ $notification->read_at }}</a>
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