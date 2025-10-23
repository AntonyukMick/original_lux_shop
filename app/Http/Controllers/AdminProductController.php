<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    /**
     * Показать страницу управления товарами
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('admin.products', compact('products'));
    }

    /**
     * Создать новый товар
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'subcat' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|max:4096',
            'image_url' => 'nullable|url',
            'sizes' => 'nullable|string',
            'gender' => 'nullable|string',
            'colors' => 'nullable|string',
        ]);

        try {
            $data = $request->all();
            
            // Обработка изображений
            $images = [];
            
            // Если загружены файлы
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    if ($image->isValid()) {
                        $path = $image->store('products', 'public');
                        $images[] = '/storage/' . $path;
                    }
                }
            }
            
            // Если указан URL изображения
            if ($request->filled('image_url')) {
                $images[] = $request->image_url;
            }
            
            // Если нет изображений, используем дефолтное
            if (empty($images)) {
                $images = ['https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop'];
            }
            
            $data['images'] = $images;
            
            // Обработка размеров
            if ($request->filled('sizes')) {
                $sizes = json_decode($request->sizes, true);
                if (is_array($sizes)) {
                    $data['sizes'] = $sizes;
                }
            }
            
            // Обработка пола
            if ($request->filled('gender')) {
                $gender = json_decode($request->gender, true);
                if (is_array($gender)) {
                    $data['gender'] = $gender;
                }
            }
            
            // Обработка цветов
            if ($request->filled('colors')) {
                $colors = json_decode($request->colors, true);
                if (is_array($colors)) {
                    $data['colors'] = $colors;
                }
            }
            
            $product = $this->productService->createProduct($data);

            return redirect()->route('admin.products.index')
                ->with('success', 'Товар успешно создан!');

        } catch (\Exception $e) {
            Log::error('Admin product creation error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['images'])
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Произошла ошибка при создании товара: ' . $e->getMessage());
        }
    }

    /**
     * Удалить товар
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $this->productService->deleteProduct($product);

            return redirect()->route('admin.products.index')
                ->with('success', 'Товар успешно удален!');

        } catch (\Exception $e) {
            Log::error('Admin product deletion error', [
                'product_id' => $id,
                'error' => $e->getMessage()
            ]);

            return redirect()->back()
                ->with('error', 'Произошла ошибка при удалении товара: ' . $e->getMessage());
        }
    }
}
