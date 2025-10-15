@extends('layouts.app')

@section('title', 'Оформление заказа | ORIGINAL | LUX SHOP')

@section('content')
<div class="container">
    <div class="panel">
        <h2>🛒 Оформление заказа</h2>
        
        <div class="order-summary" style="margin-bottom: 24px; padding: 16px; background: #f8fafc; border-radius: 8px;">
            <h3>Ваш заказ:</h3>
            @foreach($cart as $item)
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                <span>{{ $item['title'] }} x {{ $item['quantity'] }}</span>
                <span>{{ $item['price'] * $item['quantity'] }}€</span>
            </div>
            @endforeach
            <hr>
            <div style="display: flex; justify-content: space-between; font-weight: bold;">
                <span>Итого:</span>
                <span>{{ $total }}€</span>
            </div>
        </div>

        <form method="POST" action="{{ route('simple-order.process') }}">
            @csrf
            
            <div class="form-group" style="margin-bottom: 16px;">
                <label for="customer_name">👤 Ваше имя *</label>
                <input type="text" id="customer_name" name="customer_name" required 
                       style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px;"
                       value="{{ old('customer_name') }}">
                @error('customer_name')
                    <div style="color: #dc2626; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 16px;">
                <label for="customer_phone">📞 Телефон *</label>
                <input type="tel" id="customer_phone" name="customer_phone" required 
                       style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px;"
                       value="{{ old('customer_phone') }}" placeholder="+375 (XX) XXX-XX-XX">
                @error('customer_phone')
                    <div style="color: #dc2626; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 16px;">
                <label for="customer_address">📍 Адрес доставки *</label>
                <textarea id="customer_address" name="customer_address" required rows="3"
                          style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px;"
                          placeholder="Укажите полный адрес доставки">{{ old('customer_address') }}</textarea>
                @error('customer_address')
                    <div style="color: #dc2626; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 24px;">
                <label for="notes">📝 Комментарий к заказу</label>
                <textarea id="notes" name="notes" rows="2"
                          style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px;"
                          placeholder="Дополнительная информация о заказе">{{ old('notes') }}</textarea>
                @error('notes')
                    <div style="color: #dc2626; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="text-align: center;">
                <button type="submit" style="background: #527ea6; color: white; padding: 16px 32px; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background 0.2s;">
                    📤 Отправить заказ
                </button>
            </div>
        </form>

        <div style="margin-top: 24px; padding: 16px; background: #e0f2fe; border-radius: 8px; text-align: center;">
            <p style="margin: 0; color: #0277bd;">
                💬 После отправки заказа мы свяжемся с вами в Telegram для подтверждения и уточнения деталей
            </p>
        </div>

        <div style="margin-top: 16px; text-align: center;">
            <a href="{{ route('cart.index') }}" style="color: #64748b; text-decoration: none;">
                ← Вернуться в корзину
            </a>
        </div>
    </div>
</div>

<style>
@media (max-width: 768px) {
    .container {
        padding: 0 12px;
    }
    
    .panel {
        padding: 16px;
    }
    
    .order-summary {
        padding: 12px;
    }
    
    .form-group label {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
    }
    
    .form-group input,
    .form-group textarea {
        font-size: 16px;
    }
    
    button {
        width: 100%;
        padding: 14px;
        font-size: 16px;
    }
}
</style>
@endsection
