<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Order;
use App\Models\VideoLink;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StatisticsService
{
    /**
     * Получить общую статистику для дашборда
     */
    public function getDashboardStatistics(): array
    {
        return [
            'products' => $this->getProductStatistics(),
            'orders' => $this->getOrderStatistics(),
            'videos' => $this->getVideoStatistics(),
            'users' => $this->getUserStatistics(),
            'recent_activity' => $this->getRecentActivity()
        ];
    }

    /**
     * Статистика по товарам
     */
    public function getProductStatistics(): array
    {
        return [
            'total' => Product::count(),
            'active' => Product::where('is_active', true)->count(),
            'inactive' => Product::where('is_active', false)->count(),
            'by_category' => Product::select('category', DB::raw('count(*) as count'))
                ->groupBy('category')
                ->get()
                ->pluck('count', 'category')
                ->toArray()
        ];
    }

    /**
     * Статистика по заказам
     */
    public function getOrderStatistics(): array
    {
        return [
            'total' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'completed' => Order::where('status', 'delivered')->count(), // Используем 'delivered' вместо 'completed'
            'cancelled' => Order::where('status', 'cancelled')->count(),
            'total_revenue' => Order::where('status', 'delivered')->sum('total'), // Используем 'total' вместо 'total_amount'
            'average_order_value' => Order::where('status', 'delivered')->avg('total') // Используем 'total' вместо 'total_amount'
        ];
    }

    /**
     * Статистика по видео
     */
    public function getVideoStatistics(): array
    {
        return [
            'total' => VideoLink::count(),
            'active' => VideoLink::where('is_active', true)->count(),
            'inactive' => VideoLink::where('is_active', false)->count()
        ];
    }

    /**
     * Статистика по пользователям
     */
    public function getUserStatistics(): array
    {
        return [
            'total' => User::count(),
            'active' => User::where('is_active', true)->count(),
            'by_role' => User::select('role', DB::raw('count(*) as count'))
                ->groupBy('role')
                ->get()
                ->pluck('count', 'role')
                ->toArray()
        ];
    }

    /**
     * Последняя активность
     */
    public function getRecentActivity(): array
    {
        return [
            'recent_orders' => Order::with('user')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get(),
            'recent_products' => Product::orderBy('created_at', 'desc')
                ->limit(5)
                ->get(),
            'recent_users' => User::orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
        ];
    }

    /**
     * Статистика продаж за период
     */
    public function getSalesStatistics(string $period = 'month'): array
    {
        $dateFormat = match($period) {
            'day' => '%Y-%m-%d',
            'week' => '%Y-%u',
            'month' => '%Y-%m',
            'year' => '%Y',
            default => '%Y-%m'
        };

        return Order::where('status', 'delivered')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '{$dateFormat}') as period"),
                DB::raw('COUNT(*) as orders_count'),
                DB::raw('SUM(total) as total_revenue'),
                DB::raw('AVG(total) as avg_order_value')
            )
            ->groupBy('period')
            ->orderBy('period', 'desc')
            ->limit(12)
            ->get()
            ->toArray();
    }

    /**
     * Топ товаров по продажам
     */
    public function getTopSellingProducts(int $limit = 10): array
    {
        return DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->select(
                'products.title',
                'products.brand',
                'products.price',
                DB::raw('SUM(order_items.quantity) as total_sold'),
                DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue')
            )
            ->groupBy('products.id', 'products.title', 'products.brand', 'products.price')
            ->orderBy('total_sold', 'desc')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    /**
     * Статистика по категориям товаров
     */
    public function getCategoryStatistics(): array
    {
        return DB::table('products')
            ->select(
                'category',
                DB::raw('COUNT(*) as products_count'),
                DB::raw('AVG(price) as avg_price'),
                DB::raw('MIN(price) as min_price'),
                DB::raw('MAX(price) as max_price')
            )
            ->groupBy('category')
            ->orderBy('products_count', 'desc')
            ->get()
            ->toArray();
    }
}



