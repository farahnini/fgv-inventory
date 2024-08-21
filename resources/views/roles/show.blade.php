
@extends('layouts.app')

@section('content')

<script>
    // Function to generate random soft background color
    function getRandomColor() {
        const letters = 'BCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * letters.length)];
        }
        return color;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const badges = document.querySelectorAll('.name-badge');
        badges.forEach(badge => {
            badge.style.backgroundColor = getRandomColor();
        });
    });
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{$role->name}}</div>

                <div class="card-body">
                    @php
                        $groupedPermissions = $role->permissions->groupBy(function($permission) {
                            $parts = explode('-', $permission->name);
                            return $parts[0];
                        });
                    @endphp

                    @foreach($groupedPermissions as $group => $permissions)
                        <ul>
                            <li>
                                @foreach($permissions as $index => $permission)
                                    @php
                                        $parts = explode('-', $permission->name);
                                        $reversedName = implode('', array_slice($parts, 1));
                                    @endphp
                                    {{ $reversedName }}
                                    @if ($index == count($permissions) - 2)
                                        , and
                                    @elseif ($index < count($permissions) - 2)
                                        ,
                                    @endif
                                @endforeach
                                {{ $group }}
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Users Assigned') }} ({{ $role->users->count() }})</div>

                <div class="card-body">
                    <!-- table of user assigned to $role -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($role->users as $user)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>
                                        <span class="name-badge" style="display: inline-block; width: 30px; height: 30px; border-radius: 50%; text-align: center; line-height: 30px; color: #333; font-weight: bold; margin-right: 10px;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </span>
                                        {{$user->name}}
                                    </td>
                                    <td>{{$user->email}}</td>
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