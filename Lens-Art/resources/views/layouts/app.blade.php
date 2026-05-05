<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Studio LensArt')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-lensart.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    @include('partials.navbar')

    @if (session('success'))
        <div class="flash-message">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
