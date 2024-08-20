<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">User</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('inventory-categories.index') }}">Category</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('inventory-items.index') }}">Item</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <!-- Notification Bell -->
                            <li class="nav-item dropdown">
                                <a id="navbarNotification" class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell" style="font-size: 1.5em;"></i>
                                    @if(auth()->user()->unreadNotifications->count()> 0)
                                    <span class="badge badge-danger position-absolute translate-middle p-1 bg-danger border border-light rounded-circle" style="top: 10%; right: 10%; font-size: 0.75em;">{{ auth()->user()->notifications->count()}}</span>
                                    @endif
                                </a>

                               <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarNotification" style="min-width: 300px;">
                                    <!-- Display notifications based on current user -->
                                    @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                                        <a class="dropdown-item" href="#">
                                            {{ $notification->data['message'] }}<small class="text-muted"> {{ $notification->created_at->diffForHumans() }}</small>
                                        </a>
                                        @if(!$loop->last)
                                            <div class="dropdown-divider"></div>
                                        @endif
                                    @empty
                                        <div class="dropdown-item text-center">
                                            No new notifications
                                            <br><img src="/images/happy.gif" alt="Happy Animation" class="mt-2" style="width: 80px;">
                                        </div>
                                    @endforelse


                                    <div class="text-center">
                                        <a href="{{ route('notifications.index') }}" class="btn btn-secondary btn-sm">
                                            View All Notifications ({{ auth()->user()->notifications->count() }})
                                        </a>
                                    </div>


                                    <!-- Clear Notifications Button -->
                                    @if(auth()->user()->notifications->count() > 0)
                                        <div class="dropdown-divider"></div>
                                        <form method="POST" action="{{ route('notifications.clear') }}" class="d-flex justify-content-end align-items-center mt-2">
                                            @csrf
                                            <button type="submit" class="btn btn-link text-danger p-0" style="font-size: 0.9em; text-decoration: none; color: #dc3545;">Clear Notifications  </button>                                
                                        </form>
                                    @endif
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item">
                                        Last login at: {{ auth()->user()->lastLoginAt() }}
                                    </a>
                                    <a class="dropdown-item">
                                        Last login at: {{ auth()->user()->lastLoginIp() }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>

<style>
    .badge-danger {
        background-color: #dc3545;
        color: white;
        border-radius: 50%;
        padding: 0.5em;
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 0.8em;
    }
</style>

</html>
