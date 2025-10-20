<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | ORIGINAL | LUX SHOP</title>
    
    <!-- Основные стили -->
    <link rel="stylesheet" href="{{ asset('build/assets/app-BrSR8sCT.css') }}">
    
    @include('components.admin-header-styles')
    @yield('styles')
</head>
<body>
    @include('components.admin-header')
    
    <main class="main">
        @yield('content')
    </main>
    
    <!-- Основные скрипты -->
    <script src="{{ asset('build/assets/app-Qhq6ypDa.js') }}"></script>
    @yield('scripts')
</body>
</html>