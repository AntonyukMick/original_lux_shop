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

// Детальная страница товара
Route::get('/product/{id}', function ($id) {
    // Получаем данные товара по ID (пока используем статические данные)
    $products = [
        '1' => [
            'id' => '1',
            'title' => 'Кроссовки Nike Air Force 1 x Louis Vuitton (синие)',
            'price' => 150,
            'original_price' => 800,
            'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
            'images' => [
                'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'
            ],
            'description' => 'Nike Air Force 1 x Louis Vuitton - это эксклюзивная коллаборация двух легендарных брендов. Кроссовки выполнены из премиальных материалов с использованием фирменных элементов Louis Vuitton. Модель сочетает в себе классический силуэт Air Force 1 и роскошную эстетику французского модного дома.',
            'brand' => 'Nike x Louis Vuitton',
            'category' => 'Обувь',
            'subcategory' => 'Кроссовки',
            'size' => '42',
            'colors' => [
                ['name' => 'Синий', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Белый', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Красный', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Зеленый', 'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Черный', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop']
            ]
        ],
        '2' => [
            'id' => '2',
            'title' => 'Кошелек Goyard Saint Sulpice',
            'price' => 60,
            'original_price' => 400,
            'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop',
            'images' => [
                'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop'
            ],
            'description' => 'Goyard Saint Sulpice - это компактный и элегантный картхолдер. Она выполнена из прочного канваса с кожаной отделкой и украшена фирменным монограммным принтом. Благодаря своему легкому весу и утонченному стилю, аксессуар идеально подходит для повседневного использования.',
            'brand' => 'Goyard',
            'category' => 'Сумки',
            'subcategory' => 'Кошелек',
            'size' => '11,5 см * 7,5 см',
            'colors' => [
                ['name' => 'Синий', 'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Белый', 'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Коричневый', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Оранжевый', 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Красный', 'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop']
            ]
        ],
        '3' => [
            'id' => '3',
            'title' => 'Кеды Adidas Stan Smith (белые)',
            'price' => 120,
            'original_price' => 180,
            'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
            'images' => [
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'
            ],
            'description' => 'Adidas Stan Smith - это культовая модель кед, которая стала символом стиля и комфорта. Классический дизайн с перфорированными полосками и зеленым язычком. Кеды выполнены из премиальной кожи с резиновой подошвой для максимального комфорта.',
            'brand' => 'Adidas',
            'category' => 'Обувь',
            'subcategory' => 'Кеды',
            'size' => '41',
            'colors' => [
                ['name' => 'Белый', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Черный', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Красный', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Синий', 'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Зеленый', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop']
            ]
        ],
        '4' => [
            'id' => '4',
            'title' => 'Кроссовки Puma RS-X (красные)',
            'price' => 95,
            'original_price' => 140,
            'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop',
            'images' => [
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'
            ],
            'description' => 'Puma RS-X - это ретро-модель кроссовок с объемным дизайном и яркими цветами. Модель вдохновлена 80-ми годами и сочетает в себе стиль и комфорт. Увеличенная подошва и объемный верх создают уникальный силуэт.',
            'brand' => 'Puma',
            'category' => 'Обувь',
            'subcategory' => 'Кроссовки',
            'size' => '43',
            'colors' => [
                ['name' => 'Красный', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Синий', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Белый', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Черный', 'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Желтый', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop']
            ]
        ],
        '5' => [
            'id' => '5',
            'title' => 'Лоферы Gucci Horsebit (коричневые)',
            'price' => 280,
            'original_price' => 450,
            'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
            'images' => [
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'
            ],
            'description' => 'Gucci Horsebit - это классические лоферы с фирменной металлической пряжкой в виде удил. Модель выполнена из премиальной кожи с мягкой подкладкой. Идеально подходят как для делового, так и для повседневного стиля.',
            'brand' => 'Gucci',
            'category' => 'Обувь',
            'subcategory' => 'Лоферы',
            'size' => '40',
            'colors' => [
                ['name' => 'Коричневый', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Черный', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Бордовый', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Бежевый', 'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Темно-коричневый', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop']
            ]
        ],
        '6' => [
            'id' => '6',
            'title' => 'Ботинки Dr. Martens 1460 (чёрные)',
            'price' => 180,
            'original_price' => 250,
            'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop',
            'images' => [
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'
            ],
            'description' => 'Dr. Martens 1460 - это культовая модель ботинок с 8 парами люверсов. Классический силуэт с воздушной подошвой AirWair. Ботинки выполнены из прочной кожи с мягкой подкладкой и прочной подошвой.',
            'brand' => 'Dr. Martens',
            'category' => 'Обувь',
            'subcategory' => 'Ботинки',
            'size' => '42',
            'colors' => [
                ['name' => 'Черный', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Коричневый', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Бордовый', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Белый', 'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Серый', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop']
            ]
        ],
        '7' => [
            'id' => '7',
            'title' => 'Сандалии Birkenstock Arizona (коричневые)',
            'price' => 90,
            'original_price' => 120,
            'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
            'images' => [
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'
            ],
            'description' => 'Birkenstock Arizona - это классические сандалии с регулируемыми ремешками. Модель оснащена анатомической стелькой из пробки и латекса для максимального комфорта. Идеально подходят для летнего сезона.',
            'brand' => 'Birkenstock',
            'category' => 'Обувь',
            'subcategory' => 'Сандалии',
            'size' => '41',
            'colors' => [
                ['name' => 'Коричневый', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Черный', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Бежевый', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Серый', 'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Белый', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop']
            ]
        ],
        '8' => [
            'id' => '8',
            'title' => 'Туфли Oxford Church\'s (чёрные)',
            'price' => 320,
            'original_price' => 480,
            'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop',
            'images' => [
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'
            ],
            'description' => 'Church\'s Oxford - это классические туфли оксфордского типа с закрытой шнуровкой. Модель выполнена из премиальной кожи с кожаной подкладкой и прочной подошвой. Идеально подходят для делового стиля.',
            'brand' => 'Church\'s',
            'category' => 'Обувь',
            'subcategory' => 'Туфли',
            'size' => '41',
            'colors' => [
                ['name' => 'Черный', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Коричневый', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Бордовый', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Темно-синий', 'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Серый', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop']
            ]
        ],
        '9' => [
            'id' => '9',
            'title' => 'Зип‑худи Balenciaga Tape Type (чёрный)',
            'price' => 60,
            'original_price' => 120,
            'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop',
            'images' => [
                'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop'
            ],
            'description' => 'Balenciaga Tape Type - это худи с застежкой-молнией и фирменным логотипом. Модель выполнена из мягкого хлопка с капюшоном и карманами. Идеально подходит для повседневного ношения.',
            'brand' => 'Balenciaga',
            'category' => 'Одежда',
            'subcategory' => 'Зип-худи',
            'size' => 'L',
            'colors' => [
                ['name' => 'Черный', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Белый', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Серый', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Синий', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Красный', 'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop']
            ]
        ],
        '10' => [
            'id' => '10',
            'title' => 'Шорты Stone Island (чёрные)',
            'price' => 55,
            'original_price' => 85,
            'image' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1200&auto=format&fit=crop',
            'images' => [
                'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop'
            ],
            'description' => 'Stone Island шорты - это спортивные шорты с фирменным логотипом. Модель выполнена из легкой ткани с эластичным поясом и карманами. Идеально подходят для спорта и повседневного ношения.',
            'brand' => 'Stone Island',
            'category' => 'Одежда',
            'subcategory' => 'Шорты',
            'size' => 'M',
            'colors' => [
                ['name' => 'Черный', 'image' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Серый', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Синий', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Белый', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Зеленый', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop']
            ]
        ],
        '11' => [
            'id' => '11',
            'title' => 'Футболка Nike Dri-FIT (синяя)',
            'price' => 45,
            'original_price' => 75,
            'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop',
            'images' => [
                'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop'
            ],
            'description' => 'Nike Dri-FIT - это революционная технология отведения влаги, которая помогает оставаться сухим и комфортным во время тренировок. Футболка изготовлена из легкой, дышащей ткани, которая быстро отводит пот от тела и обеспечивает быстрое высыхание. Эластичный материал не сковывает движения и обеспечивает полную свободу во время любых физических нагрузок. Фирменный логотип Nike и современный дизайн делают эту футболку идеальным выбором для спорта и активного образа жизни.',
            'brand' => 'Nike',
            'category' => 'Одежда',
            'subcategory' => 'Футболки',
            'size' => 'L',
            'colors' => [
                ['name' => 'Синий', 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Черный', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Белый', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Серый', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Красный', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop']
            ]
        ],
        '17' => [
            'id' => '17',
            'title' => 'Рюкзак Gucci Marmont (чёрный)',
            'price' => 180,
            'original_price' => 280,
            'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop',
            'images' => [
                'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop'
            ],
            'description' => 'Gucci Marmont рюкзак - это современная интерпретация классической модели с фирменной пряжкой GG. Выполнен из премиальной кожи с металлической фурнитурой и регулируемыми ремнями. Внутреннее отделение с карманами обеспечивает удобное хранение всех необходимых вещей. Идеально подходит для повседневного использования и сочетает в себе стиль, функциональность и престиж итальянского бренда.',
            'brand' => 'Gucci',
            'category' => 'Сумки',
            'subcategory' => 'Рюкзак',
            'size' => 'Универсальный',
            'colors' => [
                ['name' => 'Черный', 'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Коричневый', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Бежевый', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Белый', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Красный', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop']
            ]
        ],
        '21' => [
            'id' => '21',
            'title' => 'Часы Rolex Submariner (стальные)',
            'price' => 8500,
            'original_price' => 12000,
            'image' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop',
            'images' => [
                'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop'
            ],
            'description' => 'Rolex Submariner - это культовые часы для дайвинга, ставшие символом роскоши и надежности. Модель оснащена автоматическим механизмом Caliber 3235 с водонепроницаемостью до 300 метров. Классический дизайн с вращающимся безелем, люминесцентными маркерами и сапфировым стеклом. Стальной корпус и браслет обеспечивают исключительную прочность и долговечность. Эти часы являются инвестицией на всю жизнь и передаются из поколения в поколение.',
            'brand' => 'Rolex',
            'category' => 'Часы',
            'subcategory' => 'Механические',
            'size' => '41mm',
            'colors' => [
                ['name' => 'Стальной', 'image' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Черный циферблат', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Зеленый безель', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Синий безель', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Двухцветный', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop']
            ]
        ],
        '26' => [
            'id' => '26',
            'title' => 'Кольцо Cartier Love (золотое)',
            'price' => 3200,
            'original_price' => 4500,
            'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop',
            'images' => [
                'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop'
            ],
            'description' => 'Cartier Love кольцо - это культовое украшение, символизирующее вечную любовь и преданность. Выполнено из 18-каратного желтого золота с фирменной винтовой застежкой, которая требует специальной отвертки для снятия. Классический дизайн с декоративными винтами и гладкой поверхностью делает это кольцо узнаваемым во всем мире. Идеально подходит как для повседневного ношения, так и для особых случаев. Это украшение становится семейной реликвией и передается из поколения в поколение.',
            'brand' => 'Cartier',
            'category' => 'Украшения',
            'subcategory' => 'Кольца',
            'size' => '18',
            'colors' => [
                ['name' => 'Желтое золото', 'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Белое золото', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Розовое золото', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Платина', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'С бриллиантами', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop']
            ]
        ],
        '22' => [
            'id' => '22',
            'title' => 'Часы Omega Speedmaster (чёрные)',
            'price' => 4200,
            'original_price' => 5800,
            'image' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop',
            'images' => [
                'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop'
            ],
            'description' => 'Omega Speedmaster - это легендарные часы, побывавшие на Луне в 1969 году. Хронограф с ручным заводом и черным циферблатом оснащен тремя дополнительными циферблатами для измерения времени. Стальной корпус с сапфировым стеклом и люминесцентными маркерами обеспечивают отличную читаемость в любых условиях. Эти часы являются символом человеческих достижений и идеально подходят для спортивных мероприятий и повседневного ношения.',
            'brand' => 'Omega',
            'category' => 'Часы',
            'subcategory' => 'Хронограф',
            'size' => '42mm',
            'colors' => [
                ['name' => 'Черный циферблат', 'image' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Белый циферблат', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Синий циферблат', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Серебристый', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Двухцветный', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop']
            ]
        ],
        '32' => [
            'id' => '32',
            'title' => 'Очки Ray-Ban Aviator (золотые)',
            'price' => 180,
            'original_price' => 250,
            'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=1200&auto=format&fit=crop',
            'images' => [
                'https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop'
            ],
            'description' => 'Ray-Ban Aviator - это культовые солнцезащитные очки, созданные в 1936 году для пилотов ВВС США. Классический дизайн с металлической оправой и золотистой отделкой стал символом стиля и элегантности. Линзы из высококачественного стекла обеспечивают 100% защиту от ультрафиолетовых лучей и отличную четкость зрения. Универсальный дизайн подходит для любого лица и идеально сочетается как с деловым, так и с повседневным стилем.',
            'brand' => 'Ray-Ban',
            'category' => 'Аксессуары',
            'subcategory' => 'Очки',
            'size' => '58mm',
            'colors' => [
                ['name' => 'Золотые', 'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Серебряные', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Черные', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Розовое золото', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop'],
                ['name' => 'Бронзовые', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop']
            ]
        ]
    ];
    
    if (!isset($products[$id])) {
        // Если товар не найден в статических данных, попробуем найти в базе данных
        $product = App\Models\Product::find($id);
        if (!$product) {
            abort(404);
        }
        
        // Преобразуем данные из базы в нужный формат
        $productData = [
            'id' => $product->id,
            'title' => $product->title,
            'price' => $product->price,
            'original_price' => $product->price * 1.3, // Примерная оригинальная цена
            'image' => $product->images[0] ?? 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop',
            'images' => $product->images ?: ['https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'],
            'description' => $product->description ?? 'Описание товара будет добавлено позже.',
            'brand' => $product->brand,
            'category' => $product->category,
            'subcategory' => $product->subcat,
            'size' => 'M',
            'colors' => [
                ['name' => 'Основной', 'image' => $product->images[0] ?? 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop']
            ]
        ];
        
        return view('product', ['product' => $productData]);
    }
    
    return view('product', ['product' => $products[$id]]);
})->name('product.detail');

// Каталог товаров
Route::get('/catalog', function () {
    $products = [
        // Обувь
        ['id' => '1', 'title' => 'Кроссовки Nike Air Force 1 x Louis Vuitton (синие)', 'price' => 150, 'category' => 'Обувь', 'subcategory' => 'Кроссовки', 'brand' => 'Nike', 'image' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop', 'description' => 'Коллаборация Nike и Louis Vuitton создала уникальные кроссовки Air Force 1. Модель выполнена из премиального материала с фирменными логотипами обеих брендов. Подошва из резины обеспечивает отличное сцепление и комфорт при носке.'],
        ['id' => '3', 'title' => 'Кеды Adidas Stan Smith (белые)', 'price' => 120, 'category' => 'Обувь', 'subcategory' => 'Кеды', 'brand' => 'Adidas', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop', 'description' => 'Классические кеды Adidas Stan Smith - это икона стиля. Модель выполнена из натуральной кожи с перфорированными отверстиями для вентиляции. Зеленая подошва и фирменный логотип делают эти кеды узнаваемыми во всем мире.'],
        ['id' => '4', 'title' => 'Кроссовки Puma RS-X (красные)', 'price' => 95, 'category' => 'Обувь', 'subcategory' => 'Кроссовки', 'brand' => 'Puma', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop', 'description' => 'Puma RS-X - это ретро-модель с современным дизайном. Кроссовки выполнены из комбинации материалов с объемной подошвой и яркими цветами. Идеально подходят для повседневного ношения и спортивного стиля.'],
        ['id' => '5', 'title' => 'Лоферы Gucci Horsebit (коричневые)', 'price' => 280, 'category' => 'Обувь', 'subcategory' => 'Лоферы', 'brand' => 'Gucci', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop', 'description' => 'Лоферы Gucci Horsebit - это классическая модель с фирменной металлической пряжкой в виде удил. Выполнены из премиальной кожи с мягкой подкладкой. Подходят как для делового, так и для повседневного стиля.'],
        ['id' => '6', 'title' => 'Ботинки Dr. Martens 1460 (чёрные)', 'price' => 180, 'category' => 'Обувь', 'subcategory' => 'Ботинки', 'brand' => 'Dr. Martens', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop', 'description' => 'Dr. Martens 1460 - это культовая модель ботинок с историей. Выполнены из прочной кожи с воздушной подошвой и желтыми швами. Отличаются долговечностью и уникальным стилем, который не выходит из моды.'],
        ['id' => '7', 'title' => 'Сандалии Birkenstock Arizona (коричневые)', 'price' => 90, 'category' => 'Обувь', 'subcategory' => 'Сандалии', 'brand' => 'Birkenstock', 'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=1200&auto=format&fit=crop', 'description' => 'Birkenstock Arizona - это сандалии с анатомической стелькой из пробки. Модель выполнена из натуральной кожи с регулируемыми ремешками. Обеспечивают максимальный комфорт и поддержку стопы в течение всего дня.'],
        ['id' => '8', 'title' => 'Туфли Oxford Church\'s (чёрные)', 'price' => 320, 'category' => 'Обувь', 'subcategory' => 'Туфли', 'brand' => 'Church\'s', 'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop', 'description' => 'Oxford туфли Church\'s - это классическая модель деловой обуви. Выполнены из премиальной кожи с ручной прошивкой и кожаной подошвой. Идеально подходят для официальных мероприятий и делового стиля.'],
        
        // Одежда
        ['id' => '9', 'title' => 'Зип‑худи Balenciaga Tape Type (чёрный)', 'price' => 60, 'category' => 'Одежда', 'subcategory' => 'Зип-худи', 'brand' => 'Balenciaga', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop', 'description' => 'Зип-худи Balenciaga Tape Type - это современная интерпретация классической модели. Выполнено из премиального хлопка с фирменным логотипом и молнией. Объемный крой и качественные материалы обеспечивают комфорт и стильный внешний вид.'],
        ['id' => '10', 'title' => 'Шорты Stone Island (чёрные)', 'price' => 55, 'category' => 'Одежда', 'subcategory' => 'Шорты', 'brand' => 'Stone Island', 'image' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1200&auto=format&fit=crop', 'description' => 'Stone Island шорты - это спортивные шорты с фирменным логотипом. Модель выполнена из легкой ткани с эластичным поясом и карманами. Идеально подходят для спорта и повседневного ношения.'],
        ['id' => '11', 'title' => 'Футболка Nike Dri-FIT (синяя)', 'price' => 45, 'category' => 'Одежда', 'subcategory' => 'Футболки', 'brand' => 'Nike', 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop', 'description' => 'Футболка Nike Dri-FIT изготовлена из инновационной ткани, которая отводит влагу от тела. Технология обеспечивает быстрое высыхание и комфорт во время тренировок. Эластичный материал не сковывает движения.'],
        ['id' => '12', 'title' => 'Джинсы Levi\'s 501 (синие)', 'price' => 85, 'category' => 'Одежда', 'subcategory' => 'Джинсы', 'brand' => 'Levi\'s', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop', 'description' => 'Levi\'s 501 - это классическая модель джинсов с прямой посадкой. Выполнены из качественного денима с фирменными медными заклепками и кожаным лейблом. Подходят для любого случая и никогда не выходят из моды.'],
        ['id' => '13', 'title' => 'Пальто Burberry Heritage (бежевое)', 'price' => 450, 'category' => 'Одежда', 'subcategory' => 'Пальто', 'brand' => 'Burberry', 'image' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1200&auto=format&fit=crop', 'description' => 'Пальто Burberry Heritage - это классическая модель с фирменной клеткой. Выполнено из премиальной шерсти с подкладкой и деревянными пуговицами. Традиционный крой и качественные материалы обеспечивают элегантный вид.'],
        ['id' => '14', 'title' => 'Куртка Moncler Maya (чёрная)', 'price' => 380, 'category' => 'Одежда', 'subcategory' => 'Куртки', 'brand' => 'Moncler', 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop', 'description' => 'Куртка Moncler Maya - это культовая модель с фирменным логотипом. Выполнена из высококачественного пуха с водоотталкивающей пропиткой. Обеспечивает отличную теплоизоляцию и стильный внешний вид.'],
        ['id' => '15', 'title' => 'Рубашка Ralph Lauren Polo (белая)', 'price' => 75, 'category' => 'Одежда', 'subcategory' => 'Рубашки', 'brand' => 'Ralph Lauren', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop', 'description' => 'Рубашка Ralph Lauren Polo - это классическая модель с фирменным логотипом пони. Выполнена из премиального хлопка пике с коротким рукавом. Идеально подходит для делового и повседневного стиля.'],
        ['id' => '16', 'title' => 'Свитер Tommy Hilfiger (красный)', 'price' => 65, 'category' => 'Одежда', 'subcategory' => 'Свитера', 'brand' => 'Tommy Hilfiger', 'image' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1200&auto=format&fit=crop', 'description' => 'Свитер Tommy Hilfiger - это теплая модель с фирменным логотипом. Выполнен из мягкой шерсти с эластичным воротником. Яркий цвет и качественные материалы делают его идеальным выбором для холодной погоды.'],
        
        // Сумки
        ['id' => '2', 'title' => 'Кошелек Goyard Saint Sulpice', 'price' => 60, 'category' => 'Сумки', 'subcategory' => 'Кошелек', 'brand' => 'Goyard', 'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop', 'description' => 'Goyard Saint Sulpice - это компактный и элегантный картхолдер. Выполнен из прочного канваса с кожаной отделкой и украшен фирменным монограммным принтом. Благодаря своему легкому весу и утонченному стилю, аксессуар идеально подходит для повседневного использования.'],
        ['id' => '17', 'title' => 'Рюкзак Gucci Marmont (чёрный)', 'price' => 180, 'category' => 'Сумки', 'subcategory' => 'Рюкзак', 'brand' => 'Gucci', 'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop', 'description' => 'Gucci Marmont рюкзак - это современная интерпретация классической модели. Выполнен из премиальной кожи с фирменной пряжкой и регулируемыми ремнями. Идеально подходит для повседневного использования и сочетает в себе стиль и функциональность.'],
        ['id' => '18', 'title' => 'Клатч Chanel Classic (чёрный)', 'price' => 220, 'category' => 'Сумки', 'subcategory' => 'Клатч', 'brand' => 'Chanel', 'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1200&auto=format&fit=crop', 'description' => 'Chanel Classic клатч - это культовая модель с фирменной цепочкой и логотипом. Выполнен из премиальной кожи с металлической фурнитурой. Классический дизайн делает его идеальным аксессуаром для любого случая.'],
        ['id' => '19', 'title' => 'Торба Louis Vuitton Neverfull (коричневая)', 'price' => 190, 'category' => 'Сумки', 'subcategory' => 'Торба', 'brand' => 'Louis Vuitton', 'image' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop', 'description' => 'Louis Vuitton Neverfull - это вместительная торба с фирменным монорамным принтом. Выполнена из прочного канваса с кожаными ручками. Идеально подходит для повседневного использования и путешествий.'],
        ['id' => '20', 'title' => 'Дорожная сумка Rimowa Classic (серебристая)', 'price' => 350, 'category' => 'Сумки', 'subcategory' => 'Дорожная сумка', 'brand' => 'Rimowa', 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop', 'description' => 'Rimowa Classic - это премиальная дорожная сумка из алюминия. Выполнена с использованием инновационных технологий и отличается исключительной прочностью. Идеально подходит для частых путешествий.'],
        
        // Часы
        ['id' => '21', 'title' => 'Часы Rolex Submariner (стальные)', 'price' => 8500, 'category' => 'Часы', 'subcategory' => 'Механические', 'brand' => 'Rolex', 'image' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop', 'description' => 'Rolex Submariner - это культовые часы для дайвинга с водонепроницаемостью до 300 метров. Выполнены из нержавеющей стали с автоматическим механизмом. Классический дизайн и исключительная надежность делают их идеальным выбором для активного образа жизни.'],
        ['id' => '22', 'title' => 'Часы Omega Speedmaster (чёрные)', 'price' => 4200, 'category' => 'Часы', 'subcategory' => 'Хронограф', 'brand' => 'Omega', 'image' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop', 'description' => 'Omega Speedmaster - это легендарные часы, побывавшие на Луне. Хронограф с ручным заводом и черным циферблатом. Идеально подходят для спортивных мероприятий и повседневного ношения.'],
        ['id' => '23', 'title' => 'Часы Cartier Tank (золотые)', 'price' => 6800, 'category' => 'Часы', 'subcategory' => 'Кварцевые', 'brand' => 'Cartier', 'image' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop', 'description' => 'Cartier Tank - это классические часы с прямоугольным корпусом. Выполнены из желтого золота с кварцевым механизмом. Элегантный дизайн делает их идеальным аксессуаром для делового стиля.'],
        ['id' => '24', 'title' => 'Часы Patek Philippe Calatrava (белые)', 'price' => 12500, 'category' => 'Часы', 'subcategory' => 'Автоматические', 'brand' => 'Patek Philippe', 'image' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop', 'description' => 'Patek Philippe Calatrava - это премиальные часы с автоматическим механизмом. Выполнены из белого золота с белым циферблатом. Исключительное качество и классический дизайн делают их настоящим произведением искусства.'],
        ['id' => '25', 'title' => 'Apple Watch Series 8 (чёрный)', 'price' => 450, 'category' => 'Часы', 'subcategory' => 'Смарт-часы', 'brand' => 'Apple', 'image' => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop', 'description' => 'Apple Watch Series 8 - это современные смарт-часы с множеством функций. Отслеживание здоровья, уведомления, GPS и многое другое. Идеально подходят для активного образа жизни и повседневного использования.'],
        
        // Украшения
        ['id' => '26', 'title' => 'Кольцо Cartier Love (золотое)', 'price' => 3200, 'category' => 'Украшения', 'subcategory' => 'Кольца', 'brand' => 'Cartier', 'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop', 'description' => 'Cartier Love кольцо - это культовое украшение с фирменным дизайном. Выполнено из желтого золота с винтовой застежкой. Символизирует вечную любовь и является идеальным подарком для особых случаев.'],
        ['id' => '27', 'title' => 'Браслет Tiffany T (серебряный)', 'price' => 1800, 'category' => 'Украшения', 'subcategory' => 'Браслеты', 'brand' => 'Tiffany & Co.', 'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop', 'description' => 'Tiffany T браслет - это элегантное украшение с фирменным дизайном. Выполнен из стерлингового серебра с логотипом Tiffany. Идеально подходит для повседневного ношения и особых случаев.'],
        ['id' => '28', 'title' => 'Цепочка Hermès Chaine d\'Ancre (золотая)', 'price' => 950, 'category' => 'Украшения', 'subcategory' => 'Цепочки', 'brand' => 'Hermès', 'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop', 'description' => 'Hermès Chaine d\'Ancre - это классическая цепочка с якорным дизайном. Выполнена из желтого золота с фирменной застежкой. Универсальный дизайн делает ее идеальным аксессуаром для любого случая.'],
        ['id' => '29', 'title' => 'Серьги Van Cleef & Arpels Alhambra (золотые)', 'price' => 2800, 'category' => 'Украшения', 'subcategory' => 'Серьги', 'brand' => 'Van Cleef & Arpels', 'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop', 'description' => 'Van Cleef & Arpels Alhambra серьги - это элегантные украшения с фирменным мотивом. Выполнены из желтого золота с драгоценными камнями. Классический дизайн делает их идеальным выбором для особых случаев.'],
        ['id' => '30', 'title' => 'Подвеска Bvlgari B.zero1 (розовое золото)', 'price' => 2100, 'category' => 'Украшения', 'subcategory' => 'Подвески', 'brand' => 'Bvlgari', 'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop', 'description' => 'Bvlgari B.zero1 подвеска - это современное украшение с уникальным дизайном. Выполнена из розового золота с фирменным логотипом. Идеально подходит для повседневного ношения и особых случаев.'],
        ['id' => '31', 'title' => 'Брошь Chanel Camellia (золотая)', 'price' => 1600, 'category' => 'Украшения', 'subcategory' => 'Броши', 'brand' => 'Chanel', 'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop', 'description' => 'Chanel Camellia брошь - это элегантное украшение с цветочным мотивом. Выполнена из желтого золота с драгоценными камнями. Классический дизайн делает ее идеальным аксессуаром для особых случаев.'],
        
        // Аксессуары
        ['id' => '32', 'title' => 'Очки Ray-Ban Aviator (золотые)', 'price' => 180, 'category' => 'Аксессуары', 'subcategory' => 'Очки', 'brand' => 'Ray-Ban', 'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=1200&auto=format&fit=crop', 'description' => 'Ray-Ban Aviator - это культовые солнцезащитные очки с металлической оправой. Классический дизайн с золотистой отделкой и затемненными линзами. Идеально подходят для летнего сезона и любого стиля.'],
        ['id' => '33', 'title' => 'Ремень Hermès H (коричневый)', 'price' => 420, 'category' => 'Аксессуары', 'subcategory' => 'Ремни', 'brand' => 'Hermès', 'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=1200&auto=format&fit=crop', 'description' => 'Hermès H ремень - это классический аксессуар с фирменной пряжкой. Выполнен из премиальной кожи с металлической фурнитурой. Идеально подходит для делового и повседневного стиля.'],
        ['id' => '34', 'title' => 'Галстук Tom Ford (синий)', 'price' => 180, 'category' => 'Аксессуары', 'subcategory' => 'Галстуки', 'brand' => 'Tom Ford', 'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=1200&auto=format&fit=crop', 'description' => 'Tom Ford галстук - это элегантный аксессуар из премиального шелка. Классический дизайн с синим цветом и качественной отделкой. Идеально подходит для делового стиля и особых случаев.'],
        ['id' => '35', 'title' => 'Шарф Burberry Heritage (бежевый)', 'price' => 280, 'category' => 'Аксессуары', 'subcategory' => 'Шарфы', 'brand' => 'Burberry', 'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=1200&auto=format&fit=crop', 'description' => 'Burberry Heritage шарф - это классический аксессуар с фирменной клеткой. Выполнен из премиальной шерсти с бахромой. Идеально подходит для холодной погоды и элегантного стиля.'],
        ['id' => '36', 'title' => 'Перчатки Gucci (чёрные)', 'price' => 220, 'category' => 'Аксессуары', 'subcategory' => 'Перчатки', 'brand' => 'Gucci', 'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=1200&auto=format&fit=crop', 'description' => 'Gucci перчатки - это элегантный аксессуар из премиальной кожи. Выполнены с фирменным логотипом и качественной отделкой. Идеально подходят для холодной погоды и стильного образа.'],
        ['id' => '37', 'title' => 'Зонт Swaine Adeney Brigg (чёрный)', 'price' => 350, 'category' => 'Аксессуары', 'subcategory' => 'Зонты', 'brand' => 'Swaine Adeney Brigg', 'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=1200&auto=format&fit=crop', 'description' => 'Swaine Adeney Brigg зонт - это премиальный аксессуар ручной работы. Выполнен из качественных материалов с деревянной ручкой. Идеально подходит для дождливой погоды и элегантного стиля.'],
    ];
    
    return view('catalog', ['products' => $products]);
})->name('catalog');

// Система заказов
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\DeliveryMethod;
use App\Models\PickupPoint;
use App\Models\DeliveryTracking;

// Страница оформления заказа
Route::get('/checkout', function () {
    $cart = session('cart', []);
    if (empty($cart)) {
        return redirect('/cart')->with('error', 'Корзина пуста');
    }
    
    $subtotal = 0;
    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['qty'];
    }
    
    $shippingCost = $subtotal >= 200 ? 0 : 15; // Бесплатная доставка от 200€
    $total = $subtotal + $shippingCost;
    
    return view('checkout', [
        'cart' => $cart,
        'subtotal' => $subtotal,
        'shippingCost' => $shippingCost,
        'total' => $total
    ]);
})->name('checkout');

// Оформление заказа
Route::post('/orders', function (Request $request) {
    $cart = session('cart', []);
    if (empty($cart)) {
        return redirect('/cart')->with('error', 'Корзина пуста');
    }
    
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'customer_email' => 'required|email|max:255',
        'customer_phone' => 'required|string|max:20',
        'shipping_address' => 'required|string|max:500',
        'shipping_city' => 'required|string|max:100',
        'shipping_postal_code' => 'required|string|max:10',
        'shipping_country' => 'required|string|max:100',
        'payment_method' => 'required|in:card,cash,bank_transfer',
        'notes' => 'nullable|string|max:1000'
    ]);
    
    // Расчет сумм
    $subtotal = 0;
    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['qty'];
    }
    
    $shippingCost = $subtotal >= 200 ? 0 : 15;
    $total = $subtotal + $shippingCost;
    
    // Создание заказа
    $order = Order::create([
        'order_number' => Order::generateOrderNumber(),
        'customer_name' => $request->customer_name,
        'customer_email' => $request->customer_email,
        'customer_phone' => $request->customer_phone,
        'shipping_address' => $request->shipping_address,
        'shipping_city' => $request->shipping_city,
        'shipping_postal_code' => $request->shipping_postal_code,
        'shipping_country' => $request->shipping_country,
        'notes' => $request->notes,
        'subtotal' => $subtotal,
        'shipping_cost' => $shippingCost,
        'total' => $total,
        'payment_method' => $request->payment_method,
        'status' => 'pending',
        'payment_status' => 'pending'
    ]);
    
    // Создание элементов заказа
    foreach ($cart as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_title' => $item['title'],
            'price' => $item['price'],
            'quantity' => $item['qty'],
            'product_image' => $item['image']
        ]);
    }
    
    // Очистка корзины
    session()->forget('cart');
    
    return redirect('/orders/' . $order->id)->with('success', 'Заказ успешно оформлен!');
})->name('orders.store');

// Просмотр заказа
Route::get('/orders/{id}', function ($id) {
    $order = Order::with('items')->findOrFail($id);
    return view('order', ['order' => $order]);
})->name('orders.show');

// Профиль пользователя
Route::get('/profile', function () {
    $auth = session('auth');
    if (!$auth) {
        return redirect('/login');
    }
    return view('profile');
})->name('profile');

// Страница доставки
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

// Страница "О нас"
Route::get('/about', function () {
    $videoLinks = App\Models\VideoLink::getActive();
    return view('about', ['videoLinks' => $videoLinks]);
})->name('about');

// Админ-панель для управления видео-ссылками
Route::get('/admin/videos', function () {
    $auth = session('auth');
    if (!$auth || $auth['role'] !== 'admin') {
        return redirect('/login');
    }
    
    $videoLinks = App\Models\VideoLink::orderBy('sort_order')->get();
    return view('admin.videos', ['videoLinks' => $videoLinks]);
})->name('admin.videos');

// Главная админ-панель
Route::get('/admin', function () {
    $auth = session('auth');
    if (!$auth || $auth['role'] !== 'admin') {
        return redirect('/login');
    }
    
    return view('admin.dashboard');
})->name('admin.dashboard');

// Страница управления товарами
Route::get('/admin/products', function () {
    $auth = session('auth');
    if (!$auth || $auth['role'] !== 'admin') {
        return redirect('/login');
    }
    
    return view('admin.products');
})->name('admin.products');

// Добавление нового товара
Route::post('/admin/products', function (Illuminate\Http\Request $request) {
    $auth = session('auth');
    if (!$auth || $auth['role'] !== 'admin') {
        return redirect('/login');
    }
    
    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:100',
        'brand' => 'required|string|max:100',
        'subcat' => 'nullable|string|max:100',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'images' => 'nullable|url'
    ]);
    
    $product = new App\Models\Product();
    $product->title = $request->title;
    $product->category = $request->category;
    $product->brand = $request->brand;
    $product->subcat = $request->subcat;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->images = $request->images ? [$request->images] : [];
    $product->save();
    
    return redirect('/admin/products')->with('success', 'Товар успешно добавлен!');
})->name('admin.products.store');

// Удаление товара
Route::delete('/admin/products/{id}', function ($id) {
    $auth = session('auth');
    if (!$auth || $auth['role'] !== 'admin') {
        return redirect('/login');
    }
    
    $product = App\Models\Product::find($id);
    if ($product) {
        $product->delete();
        return redirect('/admin/products')->with('success', 'Товар успешно удален!');
    }
    
    return redirect('/admin/products')->with('error', 'Товар не найден!');
})->name('admin.products.delete');

// Сохранение видео-ссылки
Route::post('/admin/videos', function (Illuminate\Http\Request $request) {
    $auth = session('auth');
    if (!$auth || $auth['role'] !== 'admin') {
        return redirect('/login');
    }
    
    $request->validate([
        'language' => 'required|string|max:10',
        'title' => 'required|string|max:255',
        'youtube_url' => 'required|url',
        'description' => 'nullable|string',
        'is_active' => 'boolean'
    ]);
    
    $videoLink = App\Models\VideoLink::updateOrCreate(
        ['language' => $request->language],
        [
            'title' => $request->title,
            'youtube_url' => $request->youtube_url,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
            'sort_order' => $request->sort_order ?? 0
        ]
    );
    
    // Извлекаем YouTube ID
    $videoLink->extractYoutubeId();
    $videoLink->save();
    
    return redirect('/admin/videos')->with('success', 'Видео-ссылка сохранена успешно!');
})->name('admin.videos.store');

// Удаление видео-ссылки
Route::delete('/admin/videos/{id}', function ($id) {
    $auth = session('auth');
    if (!$auth || $auth['role'] !== 'admin') {
        return redirect('/login');
    }
    
    $videoLink = App\Models\VideoLink::find($id);
    if ($videoLink) {
        $videoLink->delete();
    }
    
    return redirect('/admin/videos')->with('success', 'Видео-ссылка удалена!');
})->name('admin.videos.delete');

// API для отслеживания доставки
Route::get('/api/tracking/{number}', function ($number) {
    $tracking = DeliveryTracking::where('tracking_number', $number)->first();
    
    if (!$tracking) {
        return response()->json(['error' => 'Номер отслеживания не найден'], 404);
    }
    
    return response()->json([
        'status' => $tracking->getStatusText(),
        'location' => $tracking->location,
        'estimated_delivery' => $tracking->estimated_delivery,
        'history' => $tracking->tracking_history ?? []
    ]);
});

// Список заказов (для админа)
Route::get('/admin/orders', function () {
    $auth = session('auth');
    abort_unless($auth && ($auth['role'] ?? null) === 'admin', 403);
    
    $orders = Order::with('items')->orderBy('created_at', 'desc')->paginate(20);
    return view('admin.orders', ['orders' => $orders]);
})->name('admin.orders');

// Обновление статуса заказа (для админа)
Route::post('/admin/orders/{id}/status', function (Request $request, $id) {
    $auth = session('auth');
    abort_unless($auth && ($auth['role'] ?? null) === 'admin', 403);
    
    $request->validate([
        'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
        'tracking_number' => 'nullable|string|max:100'
    ]);
    
    $order = Order::findOrFail($id);
    $order->update([
        'status' => $request->status,
        'tracking_number' => $request->tracking_number,
        'shipped_at' => $request->status === 'shipped' ? now() : null,
        'delivered_at' => $request->status === 'delivered' ? now() : null
    ]);
    
    return back()->with('success', 'Статус заказа обновлен');
})->name('admin.orders.status');

// Обновление статуса оплаты (для админа)
Route::post('/admin/orders/{id}/payment', function (Request $request, $id) {
    $auth = session('auth');
    abort_unless($auth && ($auth['role'] ?? null) === 'admin', 403);
    
    $request->validate([
        'payment_status' => 'required|in:pending,paid,failed'
    ]);
    
    $order = Order::findOrFail($id);
    $order->update(['payment_status' => $request->payment_status]);
    
    return back()->with('success', 'Статус оплаты обновлен');
})->name('admin.orders.payment');
