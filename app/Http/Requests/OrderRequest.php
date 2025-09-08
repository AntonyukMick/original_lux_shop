<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            case 'store':
                return [
                    'customer_name' => 'required|string|max:255',
                    'customer_email' => 'required|email|max:255',
                    'customer_phone' => 'required|string|max:20',
                    'shipping_address' => 'required|string|max:500',
                    'shipping_city' => 'required|string|max:100',
                    'shipping_postal_code' => 'required|string|max:10',
                    'shipping_country' => 'required|string|max:100',
                    'payment_method' => 'required|in:card,cash,bank_transfer',
                    'notes' => 'nullable|string|max:1000'
                ];
            case 'update':
                return [
                    'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
                    'tracking_number' => 'nullable|string|max:100',
                    'payment_status' => 'required|in:pending,paid,failed'
                ];
            case 'updateStatus':
                return [
                    'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
                    'tracking_number' => 'nullable|string|max:100'
                ];
            case 'updatePayment':
                return [
                    'payment_status' => 'required|in:pending,paid,failed'
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
            'customer_name.required' => 'Имя клиента обязательно',
            'customer_email.required' => 'Email клиента обязателен',
            'customer_email.email' => 'Некорректный формат email',
            'customer_phone.required' => 'Телефон клиента обязателен',
            'shipping_address.required' => 'Адрес доставки обязателен',
            'shipping_city.required' => 'Город обязателен',
            'shipping_postal_code.required' => 'Почтовый индекс обязателен',
            'shipping_country.required' => 'Страна обязательна',
            'payment_method.required' => 'Способ оплаты обязателен',
            'payment_method.in' => 'Некорректный способ оплаты',
            'status.required' => 'Статус обязателен',
            'status.in' => 'Некорректный статус',
            'payment_status.required' => 'Статус оплаты обязателен',
            'payment_status.in' => 'Некорректный статус оплаты',
        ];
    }
}
