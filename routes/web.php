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
use App\Models\VideoLink;

// Главная страница
Route::get('/', function () {
    $productService = app(\App\Services\ProductService::class);
    $featuredProducts = $productService->getFeaturedProducts(8);
    return view('home', compact('featuredProducts'));
})->name('home');

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
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::get('/cart/total', [CartController::class, 'total'])->name('cart.total');

// Избранное
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::post('/favorites/add', [FavoriteController::class, 'add'])->name('favorites.add');
Route::post('/favorites/remove', [FavoriteController::class, 'remove'])->name('favorites.remove');

// Заказы
Route::get('/checkout', [OrderController::class, 'create'])->name('checkout');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

// Тестовый маршрут для PDF
Route::get('/test-pdf', [TestPdfController::class, 'test'])->name('test.pdf');

// PDF маршруты
Route::post('/generate-order-pdf', [OrderPdfController::class, 'generateOrderPdf'])->name('generate.order.pdf');
Route::post('/preview-order-pdf', [OrderPdfController::class, 'previewOrderPdf'])->name('preview.order.pdf');

// Страницы
Route::get('/about', function () {
    $videoLinks = VideoLink::getActive();
    return view('about', ['videoLinks' => $videoLinks]);
})->name('about');

Route::get('/delivery', function () {
    $pickupPoints = [
        [
            'name' => 'ТЦ Европейский',
            'address' => 'пл. Киевского Вокзала, 2',
            'working_hours' => '10:00-22:00',
            'phone' => '+7 (495) 123-45-67'
        ],
        [
            'name' => 'ТЦ Авиапарк',
            'address' => 'Ходынский бул., 4',
            'working_hours' => '10:00-23:00',
            'phone' => '+7 (495) 234-56-78'
        ],
        [
            'name' => 'ТЦ Метрополис',
            'address' => 'Ленинградское ш., 16А',
            'working_hours' => '10:00-22:00',
            'phone' => '+7 (495) 345-67-89'
        ],
        [
            'name' => 'ТЦ Афимолл Сити',
            'address' => 'Пресненская наб., 2',
            'working_hours' => '10:00-22:00',
            'phone' => '+7 (495) 456-78-90'
        ]
    ];
    
    return view('delivery', ['pickupPoints' => $pickupPoints]);
})->name('delivery');

// API для отслеживания доставки
Route::get('/api/tracking/{number}', function ($number) {
    $tracking = \App\Models\DeliveryTracking::where('tracking_number', $number)->first();
    
    if (!$tracking) {
        return response()->json(['error' => 'Номер отслеживания не найден'], 404);
    }
    
    return response()->json([
        'status' => $tracking->getStatusText(),
        'location' => $tracking->location,
        'estimated_delivery' => $tracking->estimated_delivery,
        'history' => $tracking->tracking_history ?? []
    ]);
})->name('api.tracking');

// Админ-панель (защищена middleware)
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Управление товарами
    Route::resource('products', ProductController::class);
    
    // Управление заказами
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/statistics', [OrderController::class, 'statistics'])->name('orders.statistics');
    Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
    Route::post('/orders/{id}/payment', [OrderController::class, 'updatePayment'])->name('orders.payment');
    
    // Управление видео-ссылками
    Route::get('/videos', [AdminController::class, 'videos'])->name('videos.index');
    Route::post('/videos', [AdminController::class, 'storeVideo'])->name('videos.store');
    Route::delete('/videos/{id}', [AdminController::class, 'deleteVideo'])->name('videos.delete');
});
