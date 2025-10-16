@extends('layouts.app')

@section('title', 'Управление заказами | ORIGINAL | LUX SHOP')

@section('styles')
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { 
        font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, 'Helvetica Neue', Arial, "Noto Sans", sans-serif; 
        background: #f8fafc; 
        color: #0f172a; 
        line-height: 1.6;
    }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 16px;
        }
        
        /* Main Content */
        .main {
            padding: 32px 0;
        }
        
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }
        
        .admin-title {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
        }
        
        .admin-nav {
            display: flex;
            gap: 12px;
        }
        
        .nav-link {
            padding: 8px 16px;
            background: #fff;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            text-decoration: none;
            color: #0f172a;
            font-size: 14px;
            transition: all 0.2s;
        }
        
        .nav-link:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
        }
        
        .nav-link.active {
            background: #527ea6;
            color: #fff;
            border-color: #527ea6;
        }
        
        /* Orders Table */
        .orders-table {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
        }
        
        .table-header {
            background: #f8fafc;
            padding: 16px 24px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .table-title {
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th {
            background: #f8fafc;
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            color: #64748b;
            font-size: 14px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 0 12px;
            }
            
            .main {
                padding: 20px 0;
            }
            
            .admin-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
                margin-bottom: 20px;
            }
            
            .admin-title {
                font-size: 24px;
            }
            
            .admin-nav {
                flex-wrap: wrap;
                gap: 8px;
            }
            
            .nav-link {
                padding: 6px 12px;
                font-size: 13px;
            }
            
            .orders-table {
                overflow-x: auto;
            }
            
            .table {
                min-width: 800px;
            }
            
            .table th,
            .table td {
                padding: 8px 12px;
                font-size: 13px;
            }
            
            .table-header {
                padding: 12px 16px;
            }
            
            .table-title {
                font-size: 16px;
            }
            
            .status-badge {
                padding: 4px 8px;
                font-size: 11px;
            }
            
            .btn {
                padding: 6px 12px;
                font-size: 12px;
            }
            
            /* Модальные окна для мобильных */
            #statusModal > div,
            #paymentModal > div {
                min-width: 90%;
                max-width: 400px;
                margin: 20px;
                padding: 20px;
            }
            
            #statusModal h3,
            #paymentModal h3 {
                font-size: 18px;
            }
            
            #statusModal input,
            #statusModal select,
            #paymentModal input,
            #paymentModal select {
                height: 44px;
                font-size: 16px;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 0 8px;
            }
            
            .main {
                padding: 16px 0;
            }
            
            .admin-title {
                font-size: 20px;
            }
            
            .admin-nav {
                width: 100%;
            }
            
            .nav-link {
                flex: 1;
                text-align: center;
                padding: 8px 6px;
                font-size: 12px;
            }
            
            .table th,
            .table td {
                padding: 6px 8px;
                font-size: 12px;
            }
            
            .table-header {
                padding: 10px 12px;
            }
            
            .table-title {
                font-size: 14px;
            }
            
            .status-badge {
                padding: 3px 6px;
                font-size: 10px;
            }
            
            .btn {
                padding: 4px 8px;
                font-size: 11px;
            }
            
            /* Модальные окна для очень маленьких экранов */
            #statusModal > div,
            #paymentModal > div {
                min-width: 95%;
                margin: 10px;
                padding: 16px;
            }
            
            #statusModal h3,
            #paymentModal h3 {
                font-size: 16px;
            }
            
            #statusModal input,
            #statusModal select,
            #paymentModal input,
            #paymentModal select {
                height: 40px;
                font-size: 16px;
            }
        }
        
        .table td {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: top;
        }
        
        .table tr:hover {
            background: #f8fafc;
        }
        
        .order-number {
            font-weight: 600;
            color: #0f172a;
        }
        
        .customer-info {
            font-size: 14px;
        }
        
        .customer-name {
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 4px;
        }
        
        .customer-email {
            color: #64748b;
            font-size: 12px;
        }
        
        .order-total {
            font-weight: 700;
            color: #0f172a;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-confirmed { background: #dbeafe; color: #1e40af; }
        .status-processing { background: #fef3c7; color: #92400e; }
        .status-shipped { background: #dbeafe; color: #1e40af; }
        .status-delivered { background: #dcfce7; color: #166534; }
        .status-cancelled { background: #fee2e2; color: #991b1b; }
        
        .payment-pending { background: #fef3c7; color: #92400e; }
        .payment-paid { background: #dcfce7; color: #166534; }
        .payment-failed { background: #fee2e2; color: #991b1b; }
        
        .order-date {
            font-size: 12px;
            color: #64748b;
        }
        
        .order-actions {
            display: flex;
            gap: 8px;
        }
        
        .action-btn {
            padding: 6px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            background: #fff;
            color: #0f172a;
            text-decoration: none;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .action-btn:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
        }
        
        .action-btn.primary {
            background: #527ea6;
            color: #fff;
            border-color: #527ea6;
        }
        
        .action-btn.primary:hover {
            background: #3b5a7a;
        }
        
        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 24px;
        }
        
        .page-link {
            padding: 8px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            background: #fff;
            color: #0f172a;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
        }
        
        .page-link:hover {
            background: #f1f5f9;
        }
        
        .page-link.active {
            background: #527ea6;
            color: #fff;
            border-color: #527ea6;
        }
        
        /* Success Message */
        .success-message {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
            color: #166534;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }
            
            .table {
                font-size: 12px;
            }
            
            .table th,
            .table td {
                padding: 8px;
            }
            
            .order-actions {
                flex-direction: column;
            }
        }
    </style>
@endsection

@section('content')
<div class="main">
    <div class="container">
        @if(session('success'))
        <div class="success-message">
            ✅ {{ session('success') }}
        </div>
        @endif

        <div class="admin-header">
            <h1 class="admin-title">Управление заказами</h1>
            <div class="admin-nav">
                <a href="/" class="nav-link">Главная</a>
                <a href="/admin/orders" class="nav-link active">Заказы</a>
                <a href="/admin/products" class="nav-link">Товары</a>
            </div>
        </div>

            <div class="orders-table">
                <div class="table-header">
                    <h2 class="table-title">Список заказов ({{ $orders->total() }})</h2>
                </div>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Номер заказа</th>
                            <th>Клиент</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                            <th>Оплата</th>
                            <th>Дата</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>
                                <div class="order-number">{{ $order->order_number }}</div>
                                <div class="order-date">{{ $order->created_at->format('d.m.Y H:i') }}</div>
                            </td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-name">{{ $order->customer_name }}</div>
                                    <div class="customer-email">{{ $order->customer_email }}</div>
                                    @if($order->user)
                                        <div class="customer-telegram" style="color: #527ea6; font-size: 12px; margin-top: 2px;">
                                            👤 {{ $order->user->telegram_tag ?? $order->user->email }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="order-total">{{ $order->total }}€</div>
                                <div class="order-date">{{ $order->items->count() }} товаров</div>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $order->status }}">{{ $order->status_text }}</span>
                            </td>
                            <td>
                                <span class="status-badge payment-{{ $order->payment_status }}">{{ $order->payment_status_text }}</span>
                            </td>
                            <td>
                                <div class="order-date">{{ $order->created_at->format('d.m.Y') }}</div>
                            </td>
                            <td>
                                <div class="order-actions">
                                    <a href="/orders/{{ $order->id }}" class="action-btn">Просмотр</a>
                                    <button class="action-btn primary" onclick="showStatusModal({{ $order->id }}, '{{ $order->status }}', '{{ $order->tracking_number }}')">Статус</button>
                                    <button class="action-btn" onclick="showPaymentModal({{ $order->id }}, '{{ $order->payment_status }}')">Оплата</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($orders->hasPages())
            <div class="pagination">
                @if($orders->onFirstPage())
                    <span class="page-link">←</span>
                @else
                    <a href="{{ $orders->previousPageUrl() }}" class="page-link">←</a>
                @endif

                @foreach($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                    @if($page == $orders->currentPage())
                        <span class="page-link active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    @endif
                @endforeach

                @if($orders->hasMorePages())
                    <a href="{{ $orders->nextPageUrl() }}" class="page-link">→</a>
                @else
                    <span class="page-link">→</span>
                @endif
            </div>
            @endif
        </div>
    </main>

    <!-- Status Modal -->
    <div id="statusModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:1000">
        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:#fff;padding:24px;border-radius:12px;min-width:400px">
            <h3 style="margin:0 0 16px 0">Обновить статус заказа</h3>
            <form method="post" id="statusForm">
                @csrf
                <div style="margin-bottom:16px">
                    <label style="display:block;margin-bottom:8px;font-weight:500">Статус:</label>
                    <select name="status" style="width:100%;height:40px;border:1px solid #cbd5e1;border-radius:8px;padding:0 12px">
                        <option value="pending">Ожидает подтверждения</option>
                        <option value="confirmed">Подтвержден</option>
                        <option value="processing">В обработке</option>
                        <option value="shipped">Отправлен</option>
                        <option value="delivered">Доставлен</option>
                        <option value="cancelled">Отменен</option>
                    </select>
                </div>
                <div style="margin-bottom:16px">
                    <label style="display:block;margin-bottom:8px;font-weight:500">Номер отслеживания:</label>
                    <input type="text" name="tracking_number" style="width:100%;height:40px;border:1px solid #cbd5e1;border-radius:8px;padding:0 12px">
                </div>
                <div style="display:flex;gap:12px;justify-content:flex-end">
                    <button type="button" onclick="closeStatusModal()" style="padding:8px 16px;border:1px solid #cbd5e1;border-radius:6px;background:#fff;cursor:pointer">Отмена</button>
                    <button type="submit" style="padding:8px 16px;background:#527ea6;color:#fff;border:none;border-radius:6px;cursor:pointer">Обновить</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Payment Modal -->
    <div id="paymentModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:1000">
        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:#fff;padding:24px;border-radius:12px;min-width:400px">
            <h3 style="margin:0 0 16px 0">Обновить статус оплаты</h3>
            <form method="post" id="paymentForm">
                @csrf
                <div style="margin-bottom:16px">
                    <label style="display:block;margin-bottom:8px;font-weight:500">Статус оплаты:</label>
                    <select name="payment_status" style="width:100%;height:40px;border:1px solid #cbd5e1;border-radius:8px;padding:0 12px">
                        <option value="pending">Ожидает оплаты</option>
                        <option value="paid">Оплачен</option>
                        <option value="failed">Ошибка оплаты</option>
                    </select>
                </div>
                <div style="display:flex;gap:12px;justify-content:flex-end">
                    <button type="button" onclick="closePaymentModal()" style="padding:8px 16px;border:1px solid #cbd5e1;border-radius:6px;background:#fff;cursor:pointer">Отмена</button>
                    <button type="submit" style="padding:8px 16px;background:#527ea6;color:#fff;border:none;border-radius:6px;cursor:pointer">Обновить</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showStatusModal(orderId, currentStatus, trackingNumber) {
            const modal = document.getElementById('statusModal');
            const form = document.getElementById('statusForm');
            const statusSelect = form.querySelector('select[name="status"]');
            const trackingInput = form.querySelector('input[name="tracking_number"]');
            
            statusSelect.value = currentStatus;
            trackingInput.value = trackingNumber || '';
            form.action = `/admin/orders/${orderId}/status`;
            
            modal.style.display = 'block';
        }
        
        function closeStatusModal() {
            document.getElementById('statusModal').style.display = 'none';
        }
        
        function showPaymentModal(orderId, currentStatus) {
            const modal = document.getElementById('paymentModal');
            const form = document.getElementById('paymentForm');
            const statusSelect = form.querySelector('select[name="payment_status"]');
            
            statusSelect.value = currentStatus;
            form.action = `/admin/orders/${orderId}/payment`;
            
            modal.style.display = 'block';
        }
        
        function closePaymentModal() {
            document.getElementById('paymentModal').style.display = 'none';
        }
        
        // Close modals on outside click
        document.getElementById('statusModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeStatusModal();
            }
        });
        
        document.getElementById('paymentModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePaymentModal();
            }
        });
@endsection
