<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.5.1/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @livewireStyles
</head>

<body>
    <div class="navbar bg-base-100 border-b border-b-gray-700 sticky top-0 z-50">
        <div class="navbar-start">
            <a href="{{ url('/') }}" class="btn btn-ghost normal-case text-xl">Forum</a>
        </div>
        <div class="navbar-end gap-6">
            <button class="bi bi-bell"></button>
            @guest
                <a href="{{ url('/register') }}" class="btn btn-primary normal-case text-base">Register</a>
                <a href="{{ url('/login') }}" class="btn btn-secondary btn-outline normal-case text-base">Login</a>
            @else
                <button class="btn btn-secondary btn-outline normal-case text-base"
                    onclick="document.getElementById('logout').submit()">Logout From {{ auth()->user()->name }}</button>
                <form action="{{ url('/logout') }}" method="post" id="logout">
                    @csrf
                </form>
            @endguest
        </div>
    </div>
    @yield('main')
    @livewireScripts
</body>

</html>
