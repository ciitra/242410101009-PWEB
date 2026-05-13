<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Studio LensArt' }}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-lensart.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <main class="auth-page">
        {{ $slot }}
    </main>
</body>
</html>
