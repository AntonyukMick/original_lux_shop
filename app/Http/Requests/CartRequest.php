<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
        $action = $this->route()->getActionMethod();
        
        switch ($action) {
            case 'add':
                return [
                    'title' => 'required|string',
                    'price' => 'required|numeric|min:0',
                    'qty' => 'nullable|integer|min:1',
                    'image' => 'nullable|string',
                ];
            case 'update':
                return [
                    'key' => 'required|string',
                    'qty' => 'required|integer|min:1'
                ];
            case 'remove':
                return [
                    'key' => 'required|string'
                ];
            default:
                return [];
        }
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Название товара обязательно',
            'price.required' => 'Цена обязательна',
            'price.numeric' => 'Цена должна быть числом',
            'price.min' => 'Цена не может быть отрицательной',
            'qty.integer' => 'Количество должно быть целым числом',
            'qty.min' => 'Количество должно быть больше 0',
            'key.required' => 'Ключ товара обязателен',
        ];
    }
}
