<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class SessionSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_session_data_does_not_contain_password()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $authService = new AuthService();
        $authData = $authService->authenticate('test@example.com', 'password123');

        // Проверяем, что в сессии нет пароля
        $this->assertArrayNotHasKey('password', $authData);
        
        // Проверяем, что есть только безопасные данные
        $expectedKeys = ['id', 'username', 'email', 'role', 'phone', 'address'];
        foreach ($expectedKeys as $key) {
            $this->assertArrayHasKey($key, $authData);
        }
    }

    public function test_session_expires_properly()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $authService = new AuthService();
        $authData = $authService->authenticate('test@example.com', 'password123');
        
        // Устанавливаем сессию
        session(['auth' => $authData]);
        $this->assertTrue($authService->isAuthenticated());

        // Выходим из системы
        $authService->logout();
        $this->assertFalse($authService->isAuthenticated());
    }

    public function test_admin_middleware_protection()
    {
        // Создаем обычного пользователя
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // Создаем админа
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Тестируем доступ обычного пользователя к админке
        $authService = new AuthService();
        $userAuth = $authService->authenticate('user@example.com', 'password123');
        session(['auth' => $userAuth]);

        $response = $this->get('/admin');
        $response->assertRedirect('/login');

        // Тестируем доступ админа к админке
        $adminAuth = $authService->authenticate('admin@example.com', 'password123');
        session(['auth' => $adminAuth]);

        $response = $this->get('/admin');
        $response->assertStatus(200);
    }
}
