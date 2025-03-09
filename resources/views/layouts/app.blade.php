<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Cricket Team Manager</title>
    <!-- Include Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800">
    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('user.dashboard') }}" class="text-xl font-bold">Cricket Team Manager</a>
            <div>
                @auth
                    <a href="{{ route('user.dashboard') }}" class="mr-4 hover:text-blue-200">Dashboard</a>
                    <a href="{{ route('user.select-team') }}" class="mr-4 hover:text-blue-200">Change Team</a>
                    <a href="{{ route('user.leaderboard') }}" class="mr-4 hover:text-blue-200">Leaderboard</a>
                    <button id="logoutBtn" class="hover:text-blue-200">Logout</button>
                @else
                    @if(Route::currentRouteName() === 'login')
                        <a href="{{ route('signup') }}" class="mr-4 hover:text-blue-200">Signup</a>
                    @endif
                    @if(Route::currentRouteName() === 'signup')
                        <a href="{{ route('login') }}" class="mr-4 hover:text-blue-200">Login</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-4">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Logout Confirmation Modal -->
    <div id="logoutModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Confirm Logout</h2>
            <p class="mb-4">Are you sure you want to logout?</p>
            <form method="POST" action="{{ route('logout') }}" id="logoutForm" class="hidden">
                @csrf
            </form>
            <div class="flex justify-end space-x-4">
                <button id="cancelLogout" class="bg-gray-300 text-gray-800 p-2 rounded-md hover:bg-gray-400">Cancel</button>
                <button id="confirmLogout" class="bg-red-600 text-white p-2 rounded-md hover:bg-red-700">Logout</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#logoutBtn').on('click', function() {
                $('#logoutModal').removeClass('hidden');
            });

            $('#cancelLogout').on('click', function() {
                $('#logoutModal').addClass('hidden');
            });

            $('#confirmLogout').on('click', function() {
                $('#logoutForm').submit();
            });
        });
    </script>
</body>
</html>