@extends('layouts.app')

@section('title', 'Управление заказами')

@section('styles')
<style>
    .order-btn {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
        margin: 2px;
    }
    
    .order-btn-confirm {
        background: #10b981;
        color: white;
    }
    
    .order-btn-confirm:hover {
        background: #059669;
    }
    
    .order-btn-ship {
        background: #3b82f6;
        color: white;
    }
    
    .order-btn-ship:hover {
        background: #2563eb;
    }
    
    .order-btn-cancel {
        background: #ef4444;
        color: white;
    }
    
    .order-btn-cancel:hover {
        background: #dc2626;
    }
    
    .order-btn-group {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
    }
    
    .table th {
        background: #f8fafc;
        font-weight: 600;
        color: #374151;
        border-bottom: 2px solid #e5e7eb;
    }
    
    .table td {
        vertical-align: middle;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .badge-warning {
        background: #fbbf24;
        color: #92400e;
    }
    
    .badge-info {
        background: #3b82f6;
        color: white;
    }
    
    .badge-primary {
        background: #8b5cf6;
        color: white;
    }
    
    .badge-success {
        background: #10b981;
        color: white;
    }
    
    .card {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
        padding: 20px;
    }
    
    .card-title {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .table {
        margin-bottom: 0;
    }
    
    .table th {
        padding: 12px;
        font-size: 14px;
    }
    
    .table td {
        padding: 12px;
        font-size: 14px;
    }
    
    .text-muted {
        color: #6b7280 !important;
    }
    
    .py-5 {
        padding: 3rem 0;
    }
    
    .text-center h4 {
        color: #374151;
        margin-bottom: 8px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Управление заказами</h3>
                </div>
                <div class="card-body">
                    @if($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>№ Заказа</th>
                                        <th>Клиент</th>
                                        <th>Товары</th>
                                        <th>Сумма</th>
                                        <th>Статус</th>
                                        <th>Дата</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>
                                                <strong>{{ $order->order_number }}</strong>
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>{{ $order->customer_name }}</strong><br>
                                                    <small class="text-muted">{{ $order->customer_email }}</small><br>
                                                    <small class="text-muted">{{ $order->customer_phone }}</small>
                                                    @if($order->user && $order->user->telegram_tag)
                                                        <br>
                                                        <small class="text-muted">
                                                            <strong>Telegram:</strong> {{ $order->user->telegram_tag }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @foreach($order->items as $item)
                                                    <div class="mb-1">
                                                        <strong>{{ $item->product_title }}</strong>
                                                        @if($item->size)
                                                            <small class="text-muted">({{ $item->size }})</small>
                                                        @endif
                                                        <br>
                                                        <small class="text-muted">{{ $item->quantity }} шт. × {{ number_format($item->price, 2) }}€</small>
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td>
                                                <strong>{{ number_format($order->total, 2) }}€</strong>
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'confirmed' ? 'info' : ($order->status === 'shipped' ? 'primary' : 'success')) }}">
                                                    {{ $order->status_text }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ $order->created_at->format('d.m.Y H:i') }}
                                            </td>
                                            <td>
                                                <div class="order-btn-group">
                                                    <button type="button" class="order-btn order-btn-confirm" onclick="updateOrderStatus({{ $order->id }}, 'confirmed')">
                                                        ✓ Подтвердить
                                                    </button>
                                                    <button type="button" class="order-btn order-btn-ship" onclick="updateOrderStatus({{ $order->id }}, 'shipped')">
                                                        🚚 Отправить
                                                    </button>
                                                    <button type="button" class="order-btn order-btn-cancel" onclick="updateOrderStatus({{ $order->id }}, 'cancelled')">
                                                        ✗ Отменить
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            {{ $orders->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <h4>Заказов пока нет</h4>
                            <p class="text-muted">Когда клиенты будут оформлять заказы, они появятся здесь.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateOrderStatus(orderId, status) {
    if (!confirm('Изменить статус заказа?')) {
        return;
    }
    
    fetch(`/admin/orders/${orderId}/status-api`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            status: status
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showNotification('Статус заказа обновлен', 'success');
            location.reload();
        } else {
            showNotification('Ошибка при обновлении статуса: ' + (data.message || 'Неизвестная ошибка'), 'error');
        }
    })
    .catch(error => {
        console.error('Ошибка:', error);
        if (error.message.includes('401') || error.message.includes('403')) {
            showNotification('Необходимо войти в систему как администратор', 'error');
            setTimeout(() => {
                window.location.href = '/login';
            }, 2000);
        } else {
            showNotification('Ошибка при обновлении статуса заказа', 'error');
        }
    });
}

// Функция показа уведомлений
function showNotification(message, type = 'info') {
    console.log('showNotification called:', message, type);
    
    // Создаем элемент уведомления
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    // Стили для уведомления
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 12px 20px;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        z-index: 10000;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease;
        max-width: 300px;
    `;
    
    // Цвета в зависимости от типа
    const colors = {
        success: '#48bb78',
        error: '#ef4444',
        info: '#527ea6',
        warning: '#f59e0b'
    };
    
    notification.style.backgroundColor = colors[type] || colors.info;
    
    // Добавляем в DOM
    document.body.appendChild(notification);
    
    // Анимация появления
    setTimeout(() => {
        notification.style.opacity = '1';
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Автоматическое скрытие через 3 секунды
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}
</script>
@endsection