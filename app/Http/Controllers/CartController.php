<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\ProductCategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    protected $cartService;
    protected $productCategoryService;

    public function __construct(CartService $cartService, ProductCategoryService $productCategoryService)
    {
        $this->cartService = $cartService;
        $this->productCategoryService = $productCategoryService;
    }

    /**
     * Показать страницу корзины
     */
    public function index(): View
    {
        $cartItems = $this->cartService->getCartItems();
        $total = $this->cartService->getTotal();
        $count = $this->cartService->getCount();
        
        return view('cart', compact('cartItems', 'total', 'count'));
    }

    /**
     * Добавить товар в корзину
     */
    public function add(Request $request): JsonResponse
    {
        try {
            // Проверяем авторизацию
            if (!$this->cartService->isAuthenticated()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Для добавления товара в корзину необходимо войти в систему',
                    'requires_auth' => true
                ], 401);
            }

            $productId = $request->input('product_id');
            $title = $request->input('title');
            $price = $request->input('price');
            $quantity = $request->input('quantity', 1);
            $size = $request->input('size');
            $image = $request->input('image');

            if (!$productId || !$title || !$price) {
                return response()->json([
                    'success' => false,
                    'message' => 'Недостаточно данных для добавления товара'
                ], 400);
            }

            $this->cartService->addItem($productId, $title, $price, $quantity, $size, $image);

            return response()->json([
                'success' => true,
                'message' => 'Товар добавлен в корзину',
                'cart_count' => $this->cartService->getCount(),
                'cart_total' => $this->cartService->getTotal()
            ]);

        } catch (\Exception $e) {
            Log::error('Ошибка добавления в корзину', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Ошибка при добавлении товара в корзину'
            ], 500);
        }
    }

    /**
     * Удалить товар из корзины
     */
    public function remove(Request $request): JsonResponse
    {
        try {
            $productId = $request->input('product_id');
            $size = $request->input('size');

            if (!$productId) {
                return response()->json([
                    'success' => false,
                    'message' => 'ID товара не указан'
                ], 400);
            }

            $this->cartService->removeItem($productId, $size);

            return response()->json([
                'success' => true,
                'message' => 'Товар удален из корзины',
                'cart_count' => $this->cartService->getCount(),
                'cart_total' => $this->cartService->getTotal()
            ]);

        } catch (\Exception $e) {
            Log::error('Ошибка удаления из корзины', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Ошибка при удалении товара из корзины'
            ], 500);
        }
    }

    /**
     * Обновить количество товара
     */
    public function updateQuantity(Request $request): JsonResponse
    {
        try {
            $productId = $request->input('product_id');
            $quantity = $request->input('quantity');
            $size = $request->input('size');

            if (!$productId || !isset($quantity)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Недостаточно данных для обновления'
                ], 400);
            }

            $this->cartService->updateQuantity($productId, $quantity, $size);

            return response()->json([
                'success' => true,
                'message' => 'Количество обновлено',
                'cart_count' => $this->cartService->getCount(),
                'cart_total' => $this->cartService->getTotal()
            ]);

        } catch (\Exception $e) {
            Log::error('Ошибка обновления количества', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Ошибка при обновлении количества'
            ], 500);
        }
    }

    /**
     * Очистить корзину
     */
    public function clear(): JsonResponse
    {
        try {
            $this->cartService->clearCart();

            return response()->json([
                'success' => true,
                'message' => 'Корзина очищена',
                'cart_count' => 0,
                'cart_total' => 0
            ]);

        } catch (\Exception $e) {
            Log::error('Ошибка очистки корзины', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Ошибка при очистке корзины'
            ], 500);
        }
    }

    /**
     * Получить количество товаров в корзине
     */
    public function getCount(): JsonResponse
    {
        return response()->json([
            'count' => $this->cartService->getCount()
        ]);
    }

    /**
     * Получить общую сумму корзины
     */
    public function getTotal(): JsonResponse
    {
        return response()->json([
            'total' => $this->cartService->getTotal()
        ]);
    }

    /**
     * Получить ID товара по названию
     */
    public function getProductId(Request $request): JsonResponse
    {
        try {
            $title = $request->input('title');
            
            if (!$title) {
                return response()->json(['error' => 'Название товара не указано'], 400);
            }
            
            $product = \App\Models\Product::where('title', 'LIKE', '%' . $title . '%')->first();
            
            if ($product) {
                return response()->json([
                    'success' => true,
                    'product_id' => $product->id,
                    'title' => $product->title,
                    'price' => $product->price,
                    'image' => $product->images ? (is_array($product->images) ? $product->images[0] : $product->images) : null,
                    'category' => $product->category,
                    'brand' => $product->brand,
                    'sizes' => $this->productCategoryService->getSizesForCategory($this->productCategoryService->detectCategory($product->title))
                ]);
            }
            
            // Если товар не найден, создаем новый с правильными данными
            $productInfo = $this->productCategoryService->getProductInfo($title);
            
            $newProduct = \App\Models\Product::create([
                'title' => $title,
                'price' => 150.00, // Увеличиваем базовую цену
                'original_price' => 200.00,
                'is_active' => true,
                'featured' => false,
                'category' => $productInfo['category_name'],
                'brand' => $productInfo['brand'],
                'images' => $productInfo['images']
            ]);
            
            return response()->json([
                'success' => true,
                'product_id' => $newProduct->id,
                'title' => $newProduct->title,
                'price' => $newProduct->price,
                'image' => $newProduct->images[0],
                'category' => $newProduct->category,
                'brand' => $newProduct->brand,
                'sizes' => $productInfo['sizes']
            ]);
            
        } catch (\Exception $e) {
            Log::error('Ошибка получения ID товара', [
                'error' => $e->getMessage(),
                'title' => $request->input('title')
            ]);
            
            return response()->json(['error' => 'Ошибка сервера'], 500);
        }
    }
}