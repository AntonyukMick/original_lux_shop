<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderPdfController;
use App\Http\Controllers\TestPdfController;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\SimpleOrderController;
use App\Http\Controllers\EnhancedOrderController;
use App\Http\Controllers\AdminProductController;
use App\Models\VideoLink;

// Главная страница
Route::get('/', function () {
    $productService = app(\App\Services\ProductService::class);
    $featuredProducts = $productService->getFeaturedProducts(8);
    return view('home', compact('featuredProducts'));
})->name('home');

// Акции
Route::get('/promotions', [PromotionsController::class, 'index'])->name('promotions');

// Категории
Route::get('/category/{category}', [App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');

// Аутентификация
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout.get');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.post');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

// Товары
Route::get('/catalog', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/popular', [ProductController::class, 'popular'])->name('products.popular');
Route::get('/products/discounted', [ProductController::class, 'discounted'])->name('products.discounted');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');

// Корзина
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'getCount'])->name('cart.count');
Route::get('/cart/total', [CartController::class, 'getTotal'])->name('cart.total');
Route::post('/cart/product-id', [CartController::class, 'getProductId'])->name('cart.product-id');

// Избранное
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::post('/favorites/sync', [FavoriteController::class, 'sync'])->name('favorites.sync');
Route::get('/favorites/data', [FavoriteController::class, 'getFavoritesData'])->name('favorites.data');
Route::post('/favorites/add', [FavoriteController::class, 'add'])->name('favorites.add');
Route::post('/favorites/remove', [FavoriteController::class, 'remove'])->name('favorites.remove');

// Заказы (требуют авторизации)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [OrderController::class, 'create'])->name('checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});

// Упрощенное создание заказа из корзины
Route::post('/orders/create-from-cart', [OrderController::class, 'createFromCart'])->name('orders.create-from-cart');

// Простые заказы (без авторизации)
Route::get('/simple-order', [SimpleOrderController::class, 'showSimpleOrder'])->name('simple-order.show');
Route::post('/simple-order', [SimpleOrderController::class, 'processSimpleOrder'])->name('simple-order.process');
Route::get('/order-success', [SimpleOrderController::class, 'showSuccess'])->name('order.success');

// Улучшенная система заказов
Route::get('/enhanced-order', [EnhancedOrderController::class, 'showOrderForm'])->name('enhanced-order.show');
Route::post('/enhanced-order-process', [EnhancedOrderController::class, 'processOrder'])->name('enhanced-order.process');

// PDF маршруты
Route::post('/generate-order-pdf', [OrderPdfController::class, 'generateOrderPdf'])->name('generate.order.pdf');
Route::post('/preview-order-pdf', [OrderPdfController::class, 'previewOrderPdf'])->name('preview.order.pdf');

// Тестовый маршрут для PDF
Route::get('/test-pdf', [TestPdfController::class, 'test'])->name('test.pdf');

// Страницы
Route::get('/about', function () {
    $videoLinks = VideoLink::getActive();
    return view('about', ['videoLinks' => $videoLinks]);
})->name('about');

Route::get('/delivery', function () {
    $pickupPoints = collect(config('catalog.pickup_points'))
        ->where('is_active', true)
        ->values()
        ->toArray();
    
    return view('delivery', ['pickupPoints' => $pickupPoints]);
})->name('delivery');

// Админ-панель (защищена middleware)
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Статистика
    Route::get('/statistics', [AdminController::class, 'salesStatistics'])->name('statistics');
    Route::get('/statistics/{period}', [AdminController::class, 'salesStatistics'])->name('statistics.period');
    
    // Управление товарами (отключаем страницу создания через resource)
    Route::resource('products', ProductController::class)->except(['create']);
    
    // Простое управление товарами в админ-панели
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('products.destroy');
    // Жестко перекрываем server URL /admin/products/create -> редирект на список
    Route::get('/products/create', function () {
        return redirect()->route('admin.products.index');
    })->name('products.create');
    
    // Управление заказами
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');
    Route::get('/orders/statistics', [OrderController::class, 'statistics'])->name('orders.statistics');
    Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
    Route::post('/orders/{id}/status-api', [OrderController::class, 'updateStatusApi'])->name('orders.status-api');
    Route::post('/orders/{id}/payment', [OrderController::class, 'updatePayment'])->name('orders.payment');
    
    // Управление видео-ссылками
    Route::get('/videos', [AdminController::class, 'videos'])->name('videos.index');
    Route::post('/videos', [AdminController::class, 'storeVideo'])->name('videos.store');
    Route::delete('/videos/{id}', [AdminController::class, 'deleteVideo'])->name('videos.delete');
});

// Тестовая страница для проверки корзины
Route::get('/test-cart', function() {
    return view('test-cart');
})->name('test-cart');