@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>{{ __('My Task and Team Index') }}</span>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table" id="inventory_items-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Total Team</th>
                                <th>List Team</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->users()->count() }}</td>
                                    <td>
                                        @foreach($task->users as $user)
                                            <a class="btn btn-primary">{{ $user->name }}</a>
                                            <br>
                                        @endforeach
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