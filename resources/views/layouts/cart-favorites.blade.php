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
    <link rel="stylesheet" href="{{ asset('build/assets/app-BrSR8sCT.css') }}">
    
    @include('components.header-styles')
    @yield('styles')
</head>
<body>
    @include('components.header-cart-favorites')
    
    <main class="main">
        @yield('content')
    </main>
    
    <!-- Основные скрипты -->
    <script src="{{ asset('build/assets/app-Qhq6ypDa.js') }}"></script>
    
    <!-- Мобильные взаимодействия -->
    <script src="{{ asset('js/mobile-interactions.js') }}"></script>
    
    <!-- Исправление изображений для Android -->
    <script src="{{ asset('js/android-image-fix.js') }}"></script>
    
    @yield('scripts')
</body>
</html>
