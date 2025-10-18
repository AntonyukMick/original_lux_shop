<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'telegram_tag' => 'required|string|max:255',
            'password' => 'required|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'telegram_tag.required' => 'Telegram тег обязателен',
            'telegram_tag.max' => 'Telegram тег не должен превышать 255 символов',
            'password.required' => 'Пароль обязателен',
        ];
    }
}
