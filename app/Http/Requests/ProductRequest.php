<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'subcat' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|max:4096',
            'color_images.*' => 'nullable|image|max:5120',
            'color_names' => 'nullable|array',
            'color_names.*' => 'nullable|string|max:100',
            'existing_color_images' => 'nullable|array',
            'existing_color_names' => 'nullable|array',
            'sizes' => 'nullable|string',
            'gender' => 'nullable|string',
            'colors' => 'nullable|string',
            'size_modal_text' => 'nullable|string',
            'is_active' => 'boolean',
            'featured' => 'boolean',
            'stock_quantity' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string|max:255'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Название товара обязательно',
            'category.required' => 'Категория обязательна',
            'brand.required' => 'Бренд обязателен',
            'price.required' => 'Цена обязательна',
            'price.numeric' => 'Цена должна быть числом',
            'price.min' => 'Цена не может быть отрицательной',
            'images.*.image' => 'Файл должен быть изображением',
            'images.*.max' => 'Размер изображения не должен превышать 4MB',
        ];
    }
}
