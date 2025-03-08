<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Spirit11</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav>
        @if (auth()->check())
            <a href="{{ auth()->user()->is_admin ? route('admin.players') : route('user.players') }}">Home</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('signup') }}">Sign Up</a>
        @endif
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html>