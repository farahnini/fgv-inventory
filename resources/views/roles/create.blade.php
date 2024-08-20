@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Create Roles') }}</div>

                <div class="card-body">
                    <form method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter your role name" required>
                        </div>

                        <div class="form-group mt-2">
                            <label for="role">Permission<span class="text-danger">*</span></label>
                            @foreach ($permissions as $permission)
                            <br>
                            <label>
                                <input 
                                    type="checkbox" 
                                    name="permissions[]" 
                                    value="{{ $permission->name }}" 
                                >
                                {{ $permission->name }}
                            </label>
                            @endforeach
                        </div>

                        <div class="form-group mt-3 text-right">
                            <button type="reset" class="btn btn-warning" style="margin-right:4px;">Reset</button>
                            <button type="submit" class="btn btn-primary">+ Create Role</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection