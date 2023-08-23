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
</head>

<body>
    <div class="navbar bg-base-100">
        <div class="navbar-start">
            <a class="btn btn-ghost normal-case text-xl">Forum</a>
        </div>
        <div class="navbar-end gap-2">
            @guest
                <a class="btn btn-primary normal-case text-base">Register</a>
                <a class="btn btn-secondary btn-outline normal-case text-base">Login</a>
            @else
                <a class="btn btn-secondary btn-outline normal-case text-base">Logout</a>
            @endguest
        </div>
    </div>
    @yield('main')
</body>

</html>
