<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | ORIGINAL | LUX SHOP</title>
    @include('components.admin-header-styles')
    @yield('styles')
</head>
<body>
    @include('components.admin-header')
    
    <main class="main">
        @yield('content')
    </main>
    
    @vite(['resources/js/app.js'])
    @yield('scripts')
</body>
</html>