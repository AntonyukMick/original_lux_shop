<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function getOrdersByStatus(string $status): Collection
    {
        return $this->model->where('status', $status)->get();
    }

    public function getOrdersByUser(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)->get();
    }

    public function getPendingOrders(): Collection
    {
        return $this->model->where('status', 'pending')->get();
    }

    public function getCompletedOrders(): Collection
    {
        return $this->model->where('status', 'completed')->get();
    }

    public function getOrdersByDateRange(string $startDate, string $endDate): Collection
    {
        return $this->model->whereBetween('created_at', [$startDate, $endDate])->get();
    }

    public function getTotalRevenue(): float
    {
        return $this->model->where('status', 'completed')->sum('total_amount');
    }

    public function getAverageOrderValue(): float
    {
        return $this->model->where('status', 'completed')->avg('total_amount');
    }

    public function getOrdersWithItems(): Collection
    {
        return $this->model->with('items')->get();
    }

    public function getOrdersWithUser(): Collection
    {
        return $this->model->with('user')->get();
    }
}
