<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255|min:2',
            'telegram_tag' => 'required|string|regex:/^@[a-zA-Z0-9_]{5,32}$/|unique:users,telegram_tag',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Имя обязательно для заполнения',
            'name.min' => 'Имя должно содержать минимум 2 символа',
            'name.max' => 'Имя не должно превышать 255 символов',
            'telegram_tag.required' => 'Telegram тег обязателен для заполнения',
            'telegram_tag.regex' => 'Некорректный формат Telegram тега. Используйте @username (5-32 символа)',
            'telegram_tag.unique' => 'Пользователь с таким Telegram тегом уже зарегистрирован',
            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен содержать минимум 6 символов',
            'password.confirmed' => 'Пароли не совпадают',
            'password_confirmation.required' => 'Подтверждение пароля обязательно',
            'password_confirmation.min' => 'Подтверждение пароля должно содержать минимум 6 символов',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Дополнительная проверка совпадения паролей
            if ($this->input('password') !== $this->input('password_confirmation')) {
                $validator->errors()->add('password_confirmation', 'Пароли не совпадают');
            }
            
            // Проверка на существующий telegram тег
            if (\App\Models\User::where('telegram_tag', $this->input('telegram_tag'))->exists()) {
                $validator->errors()->add('telegram_tag', 'Пользователь с таким Telegram тегом уже зарегистрирован');
            }
        });
    }
}
