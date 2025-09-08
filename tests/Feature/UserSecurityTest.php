<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_passwords_are_hashed()
    {
        // Создаем пользователя
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // Проверяем, что пароль захеширован
        $this->assertNotEquals('password123', $user->password);
        $this->assertStringStartsWith('$2y$', $user->password); // bcrypt hash
        $this->assertTrue(Hash::check('password123', $user->password));
    }

    public function test_passwords_are_hidden_from_serialization()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // Проверяем, что пароль скрыт при сериализации
        $userArray = $user->toArray();
        $this->assertArrayNotHasKey('password', $userArray);
        
        // Проверяем, что пароль скрыт в JSON
        $userJson = $user->toJson();
        $this->assertStringNotContainsString('password', $userJson);
    }

    public function test_sensitive_data_protection()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'phone' => '+7 (999) 123-45-67',
            'address' => 'Test Address',
        ]);

        // Проверяем, что чувствительные данные не попадают в логи
        $userArray = $user->toArray();
        
        // Пароль должен быть скрыт
        $this->assertArrayNotHasKey('password', $userArray);
        
        // Но другие данные должны быть доступны
        $this->assertArrayHasKey('name', $userArray);
        $this->assertArrayHasKey('email', $userArray);
        $this->assertArrayHasKey('role', $userArray);
        
        // Чувствительные данные должны быть скрыты
        $this->assertArrayNotHasKey('phone', $userArray);
        $this->assertArrayNotHasKey('address', $userArray);
    }

    public function test_password_verification_works()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // Проверяем, что правильный пароль проходит проверку
        $this->assertTrue(Hash::check('password123', $user->password));
        
        // Проверяем, что неправильный пароль не проходит проверку
        $this->assertFalse(Hash::check('wrongpassword', $user->password));
        $this->assertFalse(Hash::check('', $user->password));
    }
}
