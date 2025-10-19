<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'telegram_tag',
        'is_active',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'phone',
        'address',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
            'phone' => 'encrypted',
            'address' => 'encrypted',
        ];
    }

    /**
     * Проверяет, является ли пользователь администратором
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Проверяет, является ли пользователь обычным пользователем
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Получить заказы пользователя
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Получить избранные товары пользователя
     */
    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'user_favorites');
    }

    /**
     * Получить роль пользователя с переводом
     */
    public function getRoleNameAttribute(): string
    {
        return config('catalog.user_roles')[$this->role] ?? $this->role;
    }
}
