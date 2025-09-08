<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PdfRequest extends FormRequest
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
            'cartItems' => 'required|string',
            'totalAmount' => 'required|numeric|min:0',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'cartItems.required' => 'Данные корзины обязательны',
            'totalAmount.required' => 'Общая сумма обязательна',
            'totalAmount.numeric' => 'Общая сумма должна быть числом',
            'totalAmount.min' => 'Общая сумма не может быть отрицательной',
        ];
    }

    /**
     * Получить данные корзины в виде массива
     */
    public function getCartItems(): array
    {
        $cartItemsJson = $this->input('cartItems', '[]');
        return json_decode($cartItemsJson, true) ?: [];
    }

    /**
     * Получить общую сумму
     */
    public function getTotalAmount(): float
    {
        return (float) $this->input('totalAmount', 0);
    }
}
