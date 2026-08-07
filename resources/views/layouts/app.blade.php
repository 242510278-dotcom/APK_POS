<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Penjualan')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{-- 1. PEMANGGILAN NAVBAR DI SINI --}}


    <div class="container mt-4">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')

    </div>

</body>
</html>
