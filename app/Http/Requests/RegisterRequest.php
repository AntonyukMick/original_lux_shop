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
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
            'phone' => 'nullable|string|max:20|regex:/^[\+]?[0-9\s\-\(\)]+$/',
            'address' => 'nullable|string|max:500',
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
            'email.required' => 'Email обязателен для заполнения',
            'email.email' => 'Некорректный формат email адреса',
            'email.unique' => 'Пользователь с таким email уже зарегистрирован',
            'email.max' => 'Email не должен превышать 255 символов',
            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен содержать минимум 6 символов',
            'password.confirmed' => 'Пароли не совпадают',
            'password_confirmation.required' => 'Подтверждение пароля обязательно',
            'password_confirmation.min' => 'Подтверждение пароля должно содержать минимум 6 символов',
            'phone.regex' => 'Некорректный формат номера телефона',
            'phone.max' => 'Телефон не должен превышать 20 символов',
            'address.max' => 'Адрес не должен превышать 500 символов',
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
            
            // Проверка на существующий email
            if (\App\Models\User::where('email', $this->input('email'))->exists()) {
                $validator->errors()->add('email', 'Пользователь с таким email уже зарегистрирован');
            }
        });
    }
}
