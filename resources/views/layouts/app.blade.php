<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | ORIGINAL | LUX SHOP</title>
    @include('components.header-styles')
    @yield('styles')
</head>
<body>
    @include('components.header')
    
    <main class="main">
        @yield('content')
    </main>
    
    @vite(['resources/js/app.js'])
    
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
