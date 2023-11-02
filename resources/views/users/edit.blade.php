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
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter your name" required autofocus>
                            <small class="form-text text-muted">e.g., John Doe</small>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="email">Email<span class="text-danger">*</span></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter your email" required>
                            <small class="form-text text-muted">e.g., john@example.com</small>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="role">Role<span class="text-danger">*</span></label>
                            <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                                <option value="Admin" {{ old('role', $user->role) === 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Staff" {{ old('role', $user->role) === 'Staff' ? 'selected' : '' }}>Staff</option>
                            </select>
                            <small class="form-text text-muted">Select your role</small>
                            @error('role')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3 text-right">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary" style="margin-right: 4px;">Back</a>
                            <button type="reset" class="btn btn-warning" style="margin-right: 4px;">Reset</button>
                            <button type="submit" class="btn btn-primary">Update</button> <!-- Change the button label to "Update" -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection