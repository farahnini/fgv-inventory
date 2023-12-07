@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User') }}</div>

                <div class="card-body">
                    <form method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" readonly>
                        </div>

                        <div class="form-group mt-2">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" readonly>        
                        </div>

                        <div class="form-group mt-2">
                            <label for="role">Role</label>
                            <input id="role" class="form-control" name="role" value="{{$user->role}}" readonly>
                        </div>

                        <div class="form-group mt-3 text-right">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary" style="margin-right: 4px;">Back</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning" style="margin-right: 4px;">Update</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection