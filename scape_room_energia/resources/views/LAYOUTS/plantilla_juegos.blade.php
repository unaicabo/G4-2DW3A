<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@200;400&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body style="font-family: 'Barlow Condensed', sans-serif;">
    <x-header_juegos></x-header_juegos>
    @yield('content')
    @vite('resources/js/app.js')
</body>

</html>
