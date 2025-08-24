<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);
    $username = (string) $request->input('username');
    $password = (string) $request->input('password');
    $role = null;
    if ($username === 'admin' && $password === 'admin') {
        $role = 'admin';
    } elseif ($username === 'user' && $password === 'user') {
        $role = 'user';
    }
    if (!$role) {
        return back()->withErrors(['username' => 'Неверные логин или пароль'])->withInput();
    }
    session(['auth' => ['username' => $username, 'role' => $role]]);
    return redirect('/');
});

Route::post('/logout', function () {
    session()->forget('auth');
    return redirect('/');
})->name('logout');

Route::post('/admin/products', function (Request $request) {
    $auth = session('auth');
    abort_unless($auth && ($auth['role'] ?? null) === 'admin', 403);
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'brand' => 'required|string|max:255',
        'subcat' => 'nullable|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'images.*' => 'nullable|image|max:4096',
    ]);
    $paths = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            $paths[] = $file->store('public/products');
        }
    }
    $product = Product::create([
        'title' => $data['title'],
        'category' => $data['category'],
        'brand' => $data['brand'],
        'subcat' => $data['subcat'] ?? null,
        'price' => $data['price'],
        'description' => $data['description'] ?? null,
        'images' => $paths,
    ]);
    return redirect('/')->with('status', 'Товар добавлен: '.$product->title);
});

// Корзина (сессия)
Route::get('/cart', function () {
    $cart = session('cart', []);
    return view('cart', ['cart' => $cart]);
})->name('cart');

Route::post('/cart/add', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|string',
        'price' => 'required|numeric|min:0',
        'qty' => 'nullable|integer|min:1',
        'image' => 'nullable|string',
    ]);
    $cart = session('cart', []);
    $key = md5($data['title'].$data['price'].($data['image'] ?? ''));
    if (!isset($cart[$key])) {
        $cart[$key] = ['title'=>$data['title'],'price'=>(float)$data['price'],'qty'=>$data['qty'] ?? 1,'image'=>$data['image'] ?? null];
    } else {
        $cart[$key]['qty'] += $data['qty'] ?? 1;
    }
    session(['cart'=>$cart]);
    return back()->with('status','Добавлено в корзину');
})->name('cart.add');

Route::post('/cart/update', function (Request $request) {
    $request->validate(['key'=>'required','qty'=>'required|integer|min:1']);
    $cart = session('cart', []);
    if (isset($cart[$request->key])) {
        $cart[$request->key]['qty'] = (int) $request->qty;
        session(['cart'=>$cart]);
    }
    return back();
})->name('cart.update');

Route::post('/cart/remove', function (Request $request) {
    $request->validate(['key'=>'required']);
    $cart = session('cart', []);
    unset($cart[$request->key]);
    session(['cart'=>$cart]);
    return back();
})->name('cart.remove');

// Избранное (сессия)
Route::get('/favorites', function () {
    $favorites = session('favorites', []);
    return view('favorites', ['favorites' => $favorites]);
})->name('favorites');

Route::post('/favorites/add', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|string',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|string',
    ]);
    $favorites = session('favorites', []);
    $key = md5($data['title'].$data['price'].($data['image'] ?? ''));
    if (!isset($favorites[$key])) {
        $favorites[$key] = [
            'title' => $data['title'],
            'price' => (float)$data['price'],
            'image' => $data['image'] ?? null
        ];
        session(['favorites' => $favorites]);
        return back()->with('status', 'Добавлено в избранное');
    } else {
        return back()->with('status', 'Товар уже в избранном');
    }
})->name('favorites.add');

Route::post('/favorites/remove', function (Request $request) {
    $request->validate(['key'=>'required']);
    $favorites = session('favorites', []);
    unset($favorites[$request->key]);
    session(['favorites' => $favorites]);
    return back()->with('status', 'Удалено из избранного');
})->name('favorites.remove');
