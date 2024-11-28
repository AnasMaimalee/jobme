<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
<div class="min-h-screen">
    <!-- Add your header/navbar here -->
    {{ $slot }}
</div>
</body>
</html>
