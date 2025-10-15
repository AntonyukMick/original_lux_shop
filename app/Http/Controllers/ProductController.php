<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use App\Services\ProductDataService;
use App\Services\AdminProductService;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected ProductDataService $productDataService,
        protected AdminProductService $adminProductService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // Проверяем, является ли это запросом из админ-панели
        if ($request->is('admin/*')) {
            $query = $request->get('search');
            $products = $this->adminProductService->getProductsForAdmin($query);

            return view('admin.products.index', compact('products', 'query'));
        }

        // Для обычного каталога
        $query = $request->get('search');
        $category = $request->get('category');
        
        if ($query) {
            $products = $this->productService->searchProducts($query);
        } elseif ($category) {
            $products = $this->productService->getProductsByCategory($category);
        } else {
            $products = $this->productService->getAllProducts();
        }

        // Преобразуем данные для совместимости с шаблоном
        $products = $this->productDataService->transformForCatalog($products);

        return view('catalog', compact('products', 'query', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        $product = $this->productService->createProduct($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успешно создан!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $product = $this->productService->getProductById($id);
        $similarProducts = $this->productService->getSimilarProducts($product);
        
        // Преобразуем данные товара для совместимости с шаблоном
        $productData = $this->productDataService->transformForDetail($product);
        
        return view('product', compact('productData', 'similarProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $product = $this->productService->getProductById($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $validated = $request->validated();
        $product = $this->productService->getProductById($id);
        $this->productService->updateProduct($product, $validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = $this->productService->getProductById($id);
        $this->productService->deleteProduct($product);

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успешно удален!');
    }

    /**
     * Получить популярные товары
     */
    public function popular(): View
    {
        $products = $this->productService->getPopularProducts();
        return view('products.popular', compact('products'));
    }

    /**
     * Получить товары со скидкой
     */
    public function discounted(): View
    {
        $products = $this->productService->getDiscountedProducts();
        return view('products.discounted', compact('products'));
    }
}
