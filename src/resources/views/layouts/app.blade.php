<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Portal Informasi Desa Bendung')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="@yield('body-class', '')">
    <a class="skip-link" href="#main-content">Lewati ke konten utama</a>

    <main id="main-content" class="app-shell @yield('shell-class', '')">
        @yield('content')
    </main>
</body>
</html>

