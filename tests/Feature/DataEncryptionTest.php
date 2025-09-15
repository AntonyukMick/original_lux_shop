<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DataEncryptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_sensitive_data_is_encrypted_in_database()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'phone' => '+7 (999) 123-45-67',
            'address' => 'Test Address, 123',
        ]);

        // Проверяем, что данные зашифрованы в базе
        $rawUser = \DB::table('users')->where('id', $user->id)->first();
        
        // Телефон и адрес должны быть зашифрованы
        $this->assertNotEquals('+7 (999) 123-45-67', $rawUser->phone);
        $this->assertNotEquals('Test Address, 123', $rawUser->address);
        
        // Но при обращении к модели данные должны расшифровываться
        $this->assertEquals('+7 (999) 123-45-67', $user->phone);
        $this->assertEquals('Test Address, 123', $user->address);
    }

    public function test_encrypted_data_is_hidden_from_serialization()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'phone' => '+7 (999) 123-45-67',
            'address' => 'Test Address, 123',
        ]);

        // Проверяем, что чувствительные данные скрыты при сериализации
        $userArray = $user->toArray();
        
        $this->assertArrayNotHasKey('password', $userArray);
        $this->assertArrayNotHasKey('phone', $userArray);
        $this->assertArrayNotHasKey('address', $userArray);
        
        // Но другие данные должны быть доступны
        $this->assertArrayHasKey('name', $userArray);
        $this->assertArrayHasKey('email', $userArray);
        $this->assertArrayHasKey('role', $userArray);
    }

    public function test_password_remains_hashed_not_encrypted()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // Пароль должен быть захеширован, а не зашифрован
        $this->assertStringStartsWith('$2y$', $user->password);
        $this->assertTrue(Hash::check('password123', $user->password));
        
        // Пароль не должен быть расшифрован при обращении к модели
        $this->assertNotEquals('password123', $user->password);
    }
}






