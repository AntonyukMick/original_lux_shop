@extends('layouts.app')

@section('title', 'Оформление заказа | ORIGINAL | LUX SHOP')

@section('content')
<div class="container">
    <div class="panel">
        <h2>🛒 Оформление заказа</h2>
        
        <form method="POST" action="{{ route('enhanced-order.process') }}" id="orderForm">
            @csrf
            
            <!-- Товары в заказе -->
            <div class="order-items" style="margin-bottom: 24px;">
                @foreach($cartItems as $index => $item)
                <div class="order-item" style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px; margin-bottom: 16px; background: #f8fafc;">
                    <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item['id'] }}">
                    <input type="hidden" name="items[{{ $index }}][quantity]" value="{{ $item['quantity'] }}">
                    
                    <div style="display: flex; gap: 16px; margin-bottom: 16px;">
                        <!-- Основная фотография товара -->
                        <div style="width: 120px; height: 120px; border-radius: 8px; overflow: hidden; background: #fff; border: 1px solid #e2e8f0;">
                            @if(!empty($item['images']))
                                <img src="{{ $item['images'][0] }}" alt="{{ $item['title'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #f1f5f9; color: #64748b;">
                                    📷
                                </div>
                            @endif
                        </div>
                        
                        <!-- Информация о товаре -->
                        <div style="flex: 1;">
                            <h3 style="margin: 0 0 8px 0; color: #1e293b; font-size: 18px;">{{ $item['title'] }}</h3>
                            <p style="margin: 0 0 4px 0; color: #64748b;">Бренд: {{ $item['brand'] }}</p>
                            <p style="margin: 0 0 4px 0; color: #64748b;">Категория: {{ $item['category'] }}</p>
                            @if($item['subcategory'])
                                <p style="margin: 0 0 4px 0; color: #64748b;">Подкатегория: {{ $item['subcategory'] }}</p>
                            @endif
                            <p style="margin: 0 0 8px 0; color: #059669; font-weight: bold; font-size: 16px;">{{ $item['price'] }}€ x {{ $item['quantity'] }} = {{ $item['price'] * $item['quantity'] }}€</p>
                        </div>
                    </div>
                    
                    <!-- Скрытые поля -->
                    <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item['id'] }}">
                    <input type="hidden" name="items[{{ $index }}][quantity]" value="{{ $item['quantity'] }}">
                    
                    <!-- Выбор размера -->
                    <div style="margin-bottom: 16px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Размер:</label>
                        <select name="items[{{ $index }}][size]" class="size-select" style="padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; background: white;">
                            <option value="">Выберите размер</option>
                            @if($item['category'] === 'Обувь')
                                @for($i = 30; $i <= 48; $i++)
                                    <option value="{{ $i }}" {{ $item['size'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            @elseif($item['category'] === 'Одежда')
                                <option value="XS" {{ $item['size'] == 'XS' ? 'selected' : '' }}>XS</option>
                                <option value="S" {{ $item['size'] == 'S' ? 'selected' : '' }}>S</option>
                                <option value="M" {{ $item['size'] == 'M' ? 'selected' : '' }}>M</option>
                                <option value="L" {{ $item['size'] == 'L' ? 'selected' : '' }}>L</option>
                                <option value="XL" {{ $item['size'] == 'XL' ? 'selected' : '' }}>XL</option>
                                <option value="XXL" {{ $item['size'] == 'XXL' ? 'selected' : '' }}>XXL</option>
                            @else
                                <option value="Универсальный" {{ $item['size'] == 'Универсальный' ? 'selected' : '' }}>Универсальный</option>
                                <option value="Один размер" {{ $item['size'] == 'Один размер' ? 'selected' : '' }}>Один размер</option>
                            @endif
                        </select>
                    </div>
                    
                    <!-- Выбор фотографий -->
                    @if(!empty($item['images']) && count($item['images']) > 1)
                    <div style="margin-bottom: 16px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Выберите фотографии для заказа:</label>
                        <div class="image-selection" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); gap: 8px;">
                            @foreach($item['images'] as $imageIndex => $image)
                            <div class="image-option" style="position: relative; cursor: pointer; border-radius: 6px; overflow: hidden; border: 2px solid #e2e8f0; transition: all 0.2s;">
                                <img src="{{ $image }}" alt="Фото {{ $imageIndex + 1 }}" style="width: 100%; height: 80px; object-fit: cover;">
                                <input type="checkbox" name="items[{{ $index }}][selected_images][]" value="{{ $image }}" style="position: absolute; top: 4px; left: 4px; transform: scale(1.2);" checked>
                                <div class="checkmark" style="position: absolute; top: 4px; left: 4px; width: 16px; height: 16px; background: #10b981; border-radius: 3px; display: flex; align-items: center; justify-content: center; color: white; font-size: 10px;">✓</div>
                            </div>
                            @endforeach
                        </div>
                        <p style="margin: 8px 0 0 0; font-size: 12px; color: #64748b;">Выберите фотографии, которые хотите получить с товаром</p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            
            <!-- Итоговая сумма -->
            <div class="order-summary" style="margin-bottom: 24px; padding: 16px; background: #f8fafc; border-radius: 8px;">
                <h3>Итого к оплате:</h3>
                <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 18px; color: #059669;">
                    <span>{{ $total }}€</span>
                </div>
            </div>
            
            <!-- Данные клиента -->
            <div class="customer-info" style="margin-bottom: 24px;">
                <h3 style="margin-bottom: 16px; color: #1e293b;">Данные для доставки</h3>
                
                <div class="form-group" style="margin-bottom: 16px;">
                    <label for="customer_name">👤 Ваше имя *</label>
                    <input type="text" id="customer_name" name="customer_name" required 
                           style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px;"
                           value="{{ old('customer_name') }}">
                    @if($errors->has('customer_name'))
                        <div style="color: #dc2626; font-size: 14px; margin-top: 4px;">{{ $errors->first('customer_name') }}</div>
                    @endif
                </div>

                <div class="form-group" style="margin-bottom: 16px;">
                    <label for="customer_phone">📞 Телефон *</label>
                    <input type="tel" id="customer_phone" name="customer_phone" required 
                           style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px;"
                           value="{{ old('customer_phone') }}" placeholder="+375 (XX) XXX-XX-XX">
                    @if($errors->has('customer_phone'))
                        <div style="color: #dc2626; font-size: 14px; margin-top: 4px;">{{ $errors->first('customer_phone') }}</div>
                    @endif
                </div>

                <div class="form-group" style="margin-bottom: 16px;">
                    <label for="customer_address">📍 Адрес доставки *</label>
                    <textarea id="customer_address" name="customer_address" required rows="3"
                              style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px;"
                              placeholder="Укажите полный адрес доставки">{{ old('customer_address') }}</textarea>
                    @if($errors->has('customer_address'))
                        <div style="color: #dc2626; font-size: 14px; margin-top: 4px;">{{ $errors->first('customer_address') }}</div>
                    @endif
                </div>

                <div class="form-group" style="margin-bottom: 24px;">
                    <label for="notes">📝 Комментарий к заказу</label>
                    <textarea id="notes" name="notes" rows="2"
                              style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px;"
                              placeholder="Дополнительная информация о заказе">{{ old('notes') }}</textarea>
                    @if($errors->has('notes'))
                        <div style="color: #dc2626; font-size: 14px; margin-top: 4px;">{{ $errors->first('notes') }}</div>
                    @endif
                </div>
            </div>

            <div style="text-align: center;">
                <button type="submit" style="background: #527ea6; color: white; padding: 16px 32px; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background 0.2s;">
                    📤 Отправить заказ
                </button>
            </div>
        </form>

        <div style="margin-top: 24px; padding: 16px; background: #e0f2fe; border-radius: 8px; text-align: center;">
            <p style="margin: 0; color: #0277bd;">
                💬 После отправки заказа мы свяжемся с вами для подтверждения и уточнения деталей
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
.image-option {
    transition: all 0.2s ease;
}

.image-option:hover {
    border-color: #10b981 !important;
    transform: scale(1.05);
}

.image-option input[type="checkbox"] {
    opacity: 0;
}

.image-option input[type="checkbox"]:checked + .checkmark {
    display: flex !important;
}

.image-option input[type="checkbox"]:not(:checked) + .checkmark {
    display: none !important;
}

.image-option input[type="checkbox"]:checked {
    opacity: 1;
}

@media (max-width: 768px) {
    .container {
        padding: 0 12px;
    }
    
    .panel {
        padding: 16px;
    }
    
    .order-item {
        padding: 12px;
    }
    
    .form-group label {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
    }
    
    .form-group input,
    .form-group textarea,
    .form-group select {
        font-size: 16px;
    }
    
    button {
        width: 100%;
        padding: 14px;
        font-size: 16px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Обработка выбора изображений
    const imageOptions = document.querySelectorAll('.image-option');
    
    imageOptions.forEach(option => {
        option.addEventListener('click', function(e) {
            if (e.target.type === 'checkbox') return;
            
            const checkbox = this.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
            
            // Обновляем визуальное состояние
            const checkmark = this.querySelector('.checkmark');
            if (checkbox.checked) {
                this.style.borderColor = '#10b981';
                checkmark.style.display = 'flex';
            } else {
                this.style.borderColor = '#e2e8f0';
                checkmark.style.display = 'none';
            }
        });
    });
    
    // Валидация формы
    document.getElementById('orderForm').addEventListener('submit', function(e) {
        const sizeSelects = document.querySelectorAll('.size-select');
        let hasErrors = false;
        
        sizeSelects.forEach((select, index) => {
            if (!select.value) {
                hasErrors = true;
                select.style.borderColor = '#dc2626';
                
                // Показываем ошибку
                let errorDiv = select.parentNode.querySelector('.size-error');
                if (!errorDiv) {
                    errorDiv = document.createElement('div');
                    errorDiv.className = 'size-error';
                    errorDiv.style.color = '#dc2626';
                    errorDiv.style.fontSize = '14px';
                    errorDiv.style.marginTop = '4px';
                    select.parentNode.appendChild(errorDiv);
                }
                errorDiv.textContent = 'Пожалуйста, выберите размер для товара';
            } else {
                select.style.borderColor = '#d1d5db';
                const errorDiv = select.parentNode.querySelector('.size-error');
                if (errorDiv) {
                    errorDiv.remove();
                }
            }
        });
        
        if (hasErrors) {
            e.preventDefault();
            alert('Пожалуйста, выберите размер для всех товаров');
        }
    });
});
</script>
@endsection
