@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Create Task and Team') }}</div>

                <div class="card-body">
                    <form method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter your name" required>
                        </div>

                        <div class="form-group mt-2">
                            <label for="role">Users<span class="text-danger">*</span></label>
                            <select id="role" class="form-control @error('role') is-invalid @enderror" name="users[]" required multiple>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
            
                        </div>

                        <div class="form-group mt-3 text-right">
                            <button type="reset" class="btn btn-warning" style="margin-right:4px;">Reset</button>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection