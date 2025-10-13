<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Удаляем существующих пользователей
        User::where('email', 'admin@example.com')->orWhere('email', 'user@example.com')->delete();
        
        try {
            // Создаем администратора
            User::create([
                'name' => 'Администратор',
                'telegram_tag' => '@admin_ols',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '+7 (495) 123-45-67',
                'address' => 'Москва, ул. Примерная, д. 1',
                'is_active' => true
            ]);

            // Создаем тестового пользователя
            User::create([
                'name' => 'Тестовый Пользователь',
                'telegram_tag' => '@testuser_ols',
                'email' => 'user@example.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'phone' => '+7 (495) 345-67-89',
                'address' => 'Москва, ул. Примерная, д. 3',
                'is_active' => true
            ]);
        } catch (\Exception $e) {
            // Если колонка telegram_tag не существует, создаем без неё
            $this->command->warn('telegram_tag column not found, creating users without it');
            
            User::create([
                'name' => 'Администратор',
                'email' => '@admin_ols',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '+7 (495) 123-45-67',
                'address' => 'Москва, ул. Примерная, д. 1',
                'is_active' => true
            ]);

            User::create([
                'name' => 'Тестовый Пользователь',
                'email' => '@testuser_ols',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'phone' => '+7 (495) 345-67-89',
                'address' => 'Москва, ул. Примерная, д. 3',
                'is_active' => true
            ]);
        }

        $this->command->info('Пользователи созданы:');
        $this->command->info('Администратор: @admin_ols / admin123');
        $this->command->info('Пользователь: @testuser_ols / user123');
    }
}
