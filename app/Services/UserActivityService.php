<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class UserActivityService
{
    /**
     * Логировать действие пользователя
     */
    public function logActivity($action, $userId = null, $details = [], Request $request = null)
    {
        $logData = [
            'action' => $action,
            'user_id' => $userId,
            'timestamp' => now()->toISOString(),
            'details' => $details
        ];

        if ($request) {
            $logData['request'] = [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'referer' => $request->header('referer')
            ];
        }

        Log::channel('user_activity')->info('User activity', $logData);
    }

    /**
     * Логировать вход пользователя
     */
    public function logLogin($userId, $email, Request $request = null)
    {
        $this->logActivity('login', $userId, [
            'email' => $email,
            'login_method' => 'email'
        ], $request);
    }

    /**
     * Логировать выход пользователя
     */
    public function logLogout($userId, Request $request = null)
    {
        $this->logActivity('logout', $userId, [], $request);
    }

    /**
     * Логировать регистрацию пользователя
     */
    public function logRegistration($userId, $email, Request $request = null)
    {
        $this->logActivity('registration', $userId, [
            'email' => $email
        ], $request);
    }

    /**
     * Логировать добавление товара в корзину
     */
    public function logAddToCart($userId, $productId, $quantity = 1, Request $request = null)
    {
        $this->logActivity('add_to_cart', $userId, [
            'product_id' => $productId,
            'quantity' => $quantity
        ], $request);
    }

    /**
     * Логировать удаление товара из корзины
     */
    public function logRemoveFromCart($userId, $productId, Request $request = null)
    {
        $this->logActivity('remove_from_cart', $userId, [
            'product_id' => $productId
        ], $request);
    }

    /**
     * Логировать добавление товара в избранное
     */
    public function logAddToFavorites($userId, $productId, Request $request = null)
    {
        $this->logActivity('add_to_favorites', $userId, [
            'product_id' => $productId
        ], $request);
    }

    /**
     * Логировать удаление товара из избранного
     */
    public function logRemoveFromFavorites($userId, $productId, Request $request = null)
    {
        $this->logActivity('remove_from_favorites', $userId, [
            'product_id' => $productId
        ], $request);
    }

    /**
     * Логировать создание заказа
     */
    public function logOrderCreation($userId, $orderId, $total, Request $request = null)
    {
        $this->logActivity('order_created', $userId, [
            'order_id' => $orderId,
            'total' => $total
        ], $request);
    }

    /**
     * Логировать просмотр товара
     */
    public function logProductView($userId, $productId, Request $request = null)
    {
        $this->logActivity('product_view', $userId, [
            'product_id' => $productId
        ], $request);
    }

    /**
     * Логировать поиск
     */
    public function logSearch($userId, $query, $resultsCount = 0, Request $request = null)
    {
        $this->logActivity('search', $userId, [
            'query' => $query,
            'results_count' => $resultsCount
        ], $request);
    }

    /**
     * Логировать изменение профиля
     */
    public function logProfileUpdate($userId, $changes, Request $request = null)
    {
        $this->logActivity('profile_update', $userId, [
            'changes' => $changes
        ], $request);
    }

    /**
     * Логировать админские действия
     */
    public function logAdminAction($adminId, $action, $targetType = null, $targetId = null, $details = [], Request $request = null)
    {
        $logData = [
            'action' => $action,
            'admin_id' => $adminId,
            'target_type' => $targetType,
            'target_id' => $targetId,
            'timestamp' => now()->toISOString(),
            'details' => $details
        ];

        if ($request) {
            $logData['request'] = [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'method' => $request->method()
            ];
        }

        Log::channel('admin_activity')->info('Admin activity', $logData);
    }

    /**
     * Получить статистику активности пользователя
     */
    public function getUserActivityStats($userId, $days = 30)
    {
        // Здесь можно добавить логику для получения статистики из логов
        // или из отдельной таблицы активности
        return [
            'total_logins' => 0,
            'total_orders' => 0,
            'total_searches' => 0,
            'last_activity' => null
        ];
    }
}

