
@extends('layouts.app')

@section('content')

<style>
    .form-check-input {
        width: 1.5em;
        height: 1.5em;
    }
</style>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Create Role') }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf

                        <!-- Role create -->
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter role name" required>
                            <small class="form-text text-muted">e.g., Admin</small>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Display permissions checkbox -->
                        <div class="form-group mt-3">
                            <label for="permissions">Assign Permissions <span class="text-danger">*</span></label>
                            <div class="row">
                                @php
                                    $groupedPermissions = $permissions->groupBy(function($permission) {
                                        return explode('-', $permission->name)[0];
                                    });
                                @endphp

                                @foreach($groupedPermissions as $group => $permissions)
                                    <div class="col-md-12">
                                        <h5 class="mt-3">{{ ucfirst($group) }} Permissions</h5>
                                        <div class="row">
                                            @foreach($permissions as $permission)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="permission{{ $permission->id }}">
                                                        <label class="form-check-label" for="permission{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('permissions')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3 text-right">
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary mr-2">Back</a>
                            <button type="reset" class="btn btn-warning mr-2">Reset</button>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection