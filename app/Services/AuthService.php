<?php

namespace App\Services;

use Illuminate\Http\Request;

class AuthService
{
    /**
     * Аутентификация пользователя
     */
    public function authenticate(string $username, string $password): ?array
    {
        // Простая проверка (в будущем заменить на базу данных)
        if ($username === 'admin' && $password === 'admin') {
            return ['username' => $username, 'role' => 'admin'];
        } elseif ($username === 'user' && $password === 'user') {
            return ['username' => $username, 'role' => 'user'];
        }

        return null;
    }

    /**
     * Регистрация пользователя
     */
    public function register(array $data): array
    {
        // Здесь будет создание пользователя в базе данных
        // Пока используем простую сессию
        return [
            'username' => $data['name'],
            'role' => 'user'
        ];
    }

    /**
     * Обновление профиля
     */
    public function updateProfile(array $data, array $currentAuth): array
    {
        return [
            'username' => $data['name'],
            'role' => $currentAuth['role'] ?? 'user'
        ];
    }

    /**
     * Выход из системы
     */
    public function logout(): void
    {
        session()->forget('auth');
    }
}
