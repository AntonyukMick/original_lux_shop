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
    
    @yield('scripts')
</body>
</html>
