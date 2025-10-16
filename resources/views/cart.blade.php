@extends('layouts.cart-favorites')

@section('title', 'Корзина')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/empty-states.css') }}">
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
<div class="cart-container">
    <div class="cart-panel">
        <div class="cart-header">
            <h1 class="cart-title">Корзина</h1>
            <div class="cart-items-count" id="cart-items-count">0 товаров</div>
        </div>
        
        <div id="cart-content">
            <!-- Контент будет загружен через JavaScript -->
        </div>
        
        <div id="cart-summary" class="cart-summary" style="display: none;">
            <div class="summary-row">
                <span class="summary-label">Итого:</span>
                <span class="summary-total" id="cart-total">0€</span>
            </div>
            
            <div class="checkout-buttons">
                <button class="btn btn-primary" onclick="checkout()">
                    Оформить заказ
                </button>
                <button class="btn btn-secondary" onclick="simpleCheckout()">
                    📱 Простое оформление
                </button>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Modal -->
@include('components.modals.faq')

<!-- Contact Modal -->
@include('components.modals.contact')
@endsection

@section('scripts')
<script src="{{ asset('js/cart.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    CartManager.init();
});
</script>
@endsection