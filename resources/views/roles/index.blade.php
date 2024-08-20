@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                        <span>{{ __('Roles Index') }}</span>
                        <a href="{{ route('roles.create') }}" class="btn btn-primary">+ Role</a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table" id="inventory_items-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Permission List</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach($role->permissions as $permission)
                                            {{ $permission->name }},
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