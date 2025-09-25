<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>@yield('title') | ORIGINAL | LUX SHOP</title>
    
    <!-- Основные стили -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile-cards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile-forms.css') }}">
    
    @include('components.header-styles')
    @yield('styles')
</head>
<body>
    @include('components.header')
    
    <main class="main">
        @yield('content')
    </main>
    
    @vite(['resources/js/app.js'])
    
    <!-- Мобильные взаимодействия -->
    <script src="{{ asset('js/mobile-interactions.js') }}"></script>
    
    <!-- Fallback script if Vite doesn't work -->
    <script>
        // Проверяем, загрузился ли основной скрипт
        setTimeout(function() {
            if (typeof window.addToCart === 'undefined') {
                console.log('Vite script not loaded, using fallback');
                // Здесь можно добавить fallback функции
            }
        }, 1000);
    </script>
    
    @yield('scripts')
</body>
</html>
