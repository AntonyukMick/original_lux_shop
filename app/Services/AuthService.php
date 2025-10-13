<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthService
{
    /**
     * Аутентификация пользователя
     */
    public function authenticate(string $telegramTag, string $password): ?array
    {
        // Попытка найти пользователя по telegram_tag
        $user = User::where('telegram_tag', $telegramTag)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }

        if (!$user->is_active) {
            return null;
        }

        // Обновляем время последнего входа
        $user->update(['last_login_at' => now()]);

        // Логируем вход
        Log::info('User logged in', [
            'user_id' => $user->id,
            'telegram_tag' => $user->telegram_tag,
            'role' => $user->role
        ]);

        return [
            'id' => $user->id,
            'username' => $user->name,
            'telegram_tag' => $user->telegram_tag,
            'email' => $user->email,
            'role' => $user->role,
            'phone' => $user->phone,
            'address' => $user->address
        ];
    }

    /**
     * Регистрация пользователя
     */
    public function register(array $data): array
    {
        $user = User::create([
            'name' => $data['name'],
            'telegram_tag' => $data['telegram_tag'],
            'email' => $data['email'] ?? null,
            'password' => Hash::make($data['password']),
            'role' => 'user',
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'is_active' => true
        ]);

        Log::info('New user registered', [
            'user_id' => $user->id,
            'telegram_tag' => $user->telegram_tag
        ]);

        return [
            'id' => $user->id,
            'username' => $user->name,
            'telegram_tag' => $user->telegram_tag,
            'email' => $user->email,
            'role' => $user->role,
            'phone' => $user->phone,
            'address' => $user->address
        ];
    }

    /**
     * Обновление профиля
     */
    public function updateProfile(array $data, array $currentAuth): array
    {
        $user = User::find($currentAuth['id']);
        
        if (!$user) {
            throw new \Exception('Пользователь не найден');
        }

        $updateData = [
            'name' => $data['name'],
            'phone' => $data['phone'] ?? $user->phone,
            'address' => $data['address'] ?? $user->address
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);

        Log::info('User profile updated', [
            'user_id' => $user->id,
            'telegram_tag' => $user->telegram_tag
        ]);

        return [
            'id' => $user->id,
            'username' => $user->name,
            'telegram_tag' => $user->telegram_tag,
            'email' => $user->email,
            'role' => $user->role,
            'phone' => $user->phone,
            'address' => $user->address
        ];
    }

    /**
     * Выход из системы
     */
    public function logout(): void
    {
        $auth = session('auth');
        if ($auth) {
            Log::info('User logged out', [
                'user_id' => $auth['id'] ?? null,
                'email' => $auth['email'] ?? null
            ]);
        }
        
        session()->forget('auth');
    }

    /**
     * Получить текущего пользователя
     */
    public function getCurrentUser(): ?User
    {
        $auth = session('auth');
        if (!$auth || !isset($auth['id'])) {
            return null;
        }

        return User::find($auth['id']);
    }

    /**
     * Проверить, является ли пользователь администратором
     */
    public function isAdmin(): bool
    {
        $auth = session('auth');
        return $auth && ($auth['role'] === 'admin');
    }

    /**
     * Проверить, авторизован ли пользователь
     */
    public function isAuthenticated(): bool
    {
        return session()->has('auth');
    }
}
