/**
 * Общие функции для всего приложения
 * Централизованное место для избежания дублирования кода
 */

console.log('common-functions.js loaded');

/**
 * Обновляет счетчики в хедере (избранное и корзина)
 * Используется на всех страницах приложения
 */
function updateHeaderCounters() {
    const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    // Обновляем счетчик избранного - ДЕСКТОП
    const favoritesBadge = document.querySelector('.favorites-badge');
    if (favoritesBadge) {
        if (favorites.length > 0) {
            favoritesBadge.textContent = favorites.length;
            favoritesBadge.style.display = 'block';
        } else {
            favoritesBadge.style.display = 'none';
        }
    }
    
    // Обновляем счетчик избранного - МОБИЛЬНЫЙ
    const mobileFavoritesBadge = document.querySelector('.mobile-favorites-badge');
    if (mobileFavoritesBadge) {
        if (favorites.length > 0) {
            mobileFavoritesBadge.textContent = favorites.length;
            mobileFavoritesBadge.style.display = 'block';
        } else {
            mobileFavoritesBadge.style.display = 'none';
        }
    }
    
    // Обновляем счетчик корзины - ДЕСКТОП
    const cartBadge = document.querySelector('.cart-badge');
    if (cartBadge) {
        const totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
        if (totalItems > 0) {
            cartBadge.textContent = totalItems;
            cartBadge.style.display = 'block';
        } else {
            cartBadge.style.display = 'none';
        }
    }
    
    // Обновляем счетчик корзины - МОБИЛЬНЫЙ
    const mobileCartBadge = document.querySelector('.mobile-cart-badge');
    if (mobileCartBadge) {
        const totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
        if (totalItems > 0) {
            mobileCartBadge.textContent = totalItems;
            mobileCartBadge.style.display = 'block';
        } else {
            mobileCartBadge.style.display = 'none';
        }
    }
}

/**
 * Простая версия обновления счетчиков для совместимости с home.blade.php
 * Использует тот же алгоритм, что и updateHeaderCounters
 */
function updateHeaderCountersSimple() {
    updateHeaderCounters();
}

/**
 * Обновляет статус товара (в корзине/избранном)
 * @param {number} productId - ID товара
 * @param {string} type - 'cart' или 'favorites'
 */
function updateProductStatus(productId, type) {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    
    const isInCart = cart.some(item => item.id === productId);
    const isInFavorites = favorites.includes(productId);
    
    // Обновляем кнопки добавления в корзину
    const addToCartBtn = document.querySelector(`[data-product-id="${productId}"][data-action="add-to-cart"]`);
    if (addToCartBtn) {
        if (isInCart) {
            addToCartBtn.innerHTML = 'В корзине';
            addToCartBtn.style.background = '#48bb78';
            addToCartBtn.style.color = '#ffffff';
        } else {
            addToCartBtn.innerHTML = 'В корзину';
            addToCartBtn.style.background = '#527ea6';
            addToCartBtn.style.color = '#ffffff';
        }
    }
    
    // Обновляем кнопки избранного
    const favoriteBtn = document.querySelector(`[data-product-id="${productId}"][data-action="toggle-favorite"]`);
    if (favoriteBtn) {
        if (isInFavorites) {
            favoriteBtn.innerHTML = '❤️';
            favoriteBtn.style.background = '#ef4444';
            favoriteBtn.style.color = '#ffffff';
        } else {
            favoriteBtn.innerHTML = '🤍';
            favoriteBtn.style.background = '#ffffff';
            favoriteBtn.style.color = '#000000';
        }
    }
}

/**
 * Синхронизирует корзину с сервером
 */
async function syncCartWithServer() {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    try {
        const response = await fetch('/cart/sync', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            },
            body: JSON.stringify({ cart: cart })
        });
        
        if (response.ok) {
            console.log('Корзина синхронизирована с сервером');
        }
    } catch (error) {
        console.error('Ошибка синхронизации корзины:', error);
    }
}

/**
 * Синхронизирует избранное с сервером
 */
async function syncFavoritesWithServer() {
    const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    
    try {
        const response = await fetch('/favorites/sync', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            },
            body: JSON.stringify({ favorites: favorites })
        });
        
        if (response.ok) {
            console.log('Избранное синхронизировано с сервером');
        }
    } catch (error) {
        console.error('Ошибка синхронизации избранного:', error);
    }
}

/**
 * Добавляет товар в корзину
 * @param {number|string} productId - ID товара или название
 * @param {number} quantity - Количество (по умолчанию 1)
 * @param {string} title - Название товара (если используется title вместо ID)
 * @param {number} price - Цена товара (если используется title)
 * @param {string} image - Изображение товара (если используется title)
 */
function addToCart(productId, quantity = 1, title = null, price = null, image = null) {
    console.log('addToCart called with:', { productId, quantity, title, price, image });
    
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    // Если передан title, используем старый формат
    if (title) {
        const existingItem = cart.find(item => item.title === title);
        if (existingItem) {
            existingItem.quantity = (existingItem.quantity || 1) + quantity;
        } else {
            cart.push({ title, price, image, quantity: quantity });
        }
    } else {
        // Используем новый формат с ID
        const existingItem = cart.find(item => item.id === productId);
        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            cart.push({ id: productId, quantity: quantity });
        }
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    console.log('Cart updated:', cart);
    
    updateHeaderCounters();
    updateProductStatus(productId, 'cart');
    
    // Синхронизируем с сервером
    syncCartWithServer();
    
    // Показываем уведомление
    showNotification('Товар добавлен в корзину', 'success');
}

/**
 * Удаляет товар из корзины
 * @param {number|string} productId - ID товара или название
 * @param {string} title - Название товара (если используется title вместо ID)
 */
function removeFromCart(productId, title = null) {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    let filteredCart;
    if (title) {
        filteredCart = cart.filter(item => item.title !== title);
    } else {
        filteredCart = cart.filter(item => item.id !== productId);
    }
    
    localStorage.setItem('cart', JSON.stringify(filteredCart));
    
    updateHeaderCounters();
    updateProductStatus(productId, 'cart');
    
    // Синхронизируем с сервером
    syncCartWithServer();
    
    // Показываем уведомление
    showNotification('Товар удален из корзины', 'info');
}

/**
 * Переключает статус избранного товара
 * @param {number|string} productId - ID товара или название
 * @param {string} title - Название товара (если используется title вместо ID)
 */
function toggleFavorite(productId, title = null) {
    const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    
    let index;
    if (title) {
        index = favorites.findIndex(item => item.title === title);
    } else {
        index = favorites.indexOf(productId);
    }
    
    if (index > -1) {
        favorites.splice(index, 1);
        showNotification('Товар удален из избранного', 'info');
    } else {
        if (title) {
            favorites.push({ title: title });
        } else {
            favorites.push(productId);
        }
        showNotification('Товар добавлен в избранное', 'success');
    }
    
    localStorage.setItem('favorites', JSON.stringify(favorites));
    updateHeaderCounters();
    updateProductStatus(productId, 'favorites');
    
    // Синхронизируем с сервером
    syncFavoritesWithServer();
}

/**
 * Показывает уведомление пользователю
 * @param {string} message - Текст сообщения
 * @param {string} type - Тип уведомления ('success', 'error', 'info', 'warning')
 */
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

/**
 * Валидация email
 * @param {string} email - Email для проверки
 * @returns {boolean} - true если email валидный
 */
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

/**
 * Валидация телефона
 * @param {string} phone - Телефон для проверки
 * @returns {boolean} - true если телефон валидный
 */
function validatePhone(phone) {
    const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
    return phoneRegex.test(phone.replace(/[\s\-\(\)]/g, ''));
}

/**
 * Расширенная валидация форм с поддержкой различных типов полей
 * @param {HTMLFormElement} form - Форма для валидации
 * @returns {boolean} - true если форма валидна
 */
function validateForm(form) {
    let isValid = true;
    const errors = [];
    
    // Проверяем обязательные поля
    const requiredFields = form.querySelectorAll('[required]');
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            const fieldName = field.getAttribute('name') || field.getAttribute('id') || 'поле';
            errors.push(`Поле "${fieldName}" обязательно для заполнения`);
            showFieldError(field, 'Поле обязательно для заполнения');
        } else {
            clearFieldError(field);
        }
    });
    
    // Проверяем email поля
    const emailFields = form.querySelectorAll('input[type="email"]');
    emailFields.forEach(field => {
        if (field.value && !validateEmail(field.value)) {
            isValid = false;
            errors.push('Некорректный формат email');
            showFieldError(field, 'Некорректный формат email');
        }
    });
    
    // Проверяем телефоны
    const phoneFields = form.querySelectorAll('input[type="tel"], input[name*="phone"]');
    phoneFields.forEach(field => {
        if (field.value && !validatePhone(field.value)) {
            isValid = false;
            errors.push('Некорректный формат телефона');
            showFieldError(field, 'Некорректный формат телефона');
        }
    });
    
    // Проверяем URL поля
    const urlFields = form.querySelectorAll('input[type="url"]');
    urlFields.forEach(field => {
        if (field.value && !validateUrl(field.value)) {
            isValid = false;
            errors.push('Некорректный формат URL');
            showFieldError(field, 'Некорректный формат URL');
        }
    });
    
    // Проверяем пароли
    const passwordFields = form.querySelectorAll('input[type="password"]');
    passwordFields.forEach(field => {
        if (field.value && field.value.length < 6) {
            isValid = false;
            errors.push('Пароль должен содержать минимум 6 символов');
            showFieldError(field, 'Пароль должен содержать минимум 6 символов');
        }
    });
    
    // Проверяем подтверждение пароля
    const passwordConfirmation = form.querySelector('input[name*="password_confirmation"]');
    const password = form.querySelector('input[name="password"]');
    if (passwordConfirmation && password && passwordConfirmation.value !== password.value) {
        isValid = false;
        errors.push('Пароли не совпадают');
        showFieldError(passwordConfirmation, 'Пароли не совпадают');
    }
    
    // Проверяем числовые поля
    const numberFields = form.querySelectorAll('input[type="number"]');
    numberFields.forEach(field => {
        if (field.value && isNaN(field.value)) {
            isValid = false;
            errors.push('Поле должно содержать только числа');
            showFieldError(field, 'Поле должно содержать только числа');
        }
    });
    
    // Показываем ошибки
    if (!isValid) {
        showNotification(errors.join(', '), 'error');
    }
    
    return isValid;
}

/**
 * Показывает ошибку для конкретного поля
 * @param {HTMLElement} field - Поле формы
 * @param {string} message - Сообщение об ошибке
 */
function showFieldError(field, message) {
    field.style.borderColor = '#ef4444';
    field.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
    
    // Удаляем предыдущую ошибку
    const existingError = field.parentNode.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
    
    // Добавляем новую ошибку
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.textContent = message;
    errorDiv.style.cssText = `
        color: #ef4444;
        font-size: 12px;
        margin-top: 4px;
        font-weight: 500;
    `;
    
    field.parentNode.appendChild(errorDiv);
}

/**
 * Очищает ошибку для конкретного поля
 * @param {HTMLElement} field - Поле формы
 */
function clearFieldError(field) {
    field.style.borderColor = '#cbd5e1';
    field.style.boxShadow = '';
    
    const existingError = field.parentNode.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
}

/**
 * Валидация URL
 * @param {string} url - URL для проверки
 * @returns {boolean} - true если URL валидный
 */
function validateUrl(url) {
    try {
        new URL(url);
        return true;
    } catch {
        return false;
    }
}

/**
 * Валидация имени (только буквы и пробелы)
 * @param {string} name - Имя для проверки
 * @returns {boolean} - true если имя валидное
 */
function validateName(name) {
    const nameRegex = /^[а-яё\s]+$/i;
    return nameRegex.test(name) && name.trim().length >= 2;
}

/**
 * Валидация адреса
 * @param {string} address - Адрес для проверки
 * @returns {boolean} - true если адрес валидный
 */
function validateAddress(address) {
    return address.trim().length >= 5;
}

/**
 * Валидация цены
 * @param {string|number} price - Цена для проверки
 * @returns {boolean} - true если цена валидная
 */
function validatePrice(price) {
    const numPrice = parseFloat(price);
    return !isNaN(numPrice) && numPrice > 0;
}

/**
 * Инициализация общих функций при загрузке страницы
 */
document.addEventListener('DOMContentLoaded', function() {
    // Обновляем счетчики при загрузке страницы
    updateHeaderCounters();
    
    // Добавляем обработчики для кнопок корзины
    document.addEventListener('click', function(e) {
        console.log('Click event:', e.target, e.target.dataset);
        
        if (e.target.matches('[data-action="add-to-cart"]')) {
            console.log('Add to cart clicked');
            e.preventDefault();
            const productId = parseInt(e.target.dataset.productId);
            const quantityInput = document.getElementById('quantity');
            const quantity = quantityInput ? parseInt(quantityInput.value) : 1;
            console.log('Adding to cart:', productId, quantity);
            addToCart(productId, quantity);
        }
        
        if (e.target.matches('[data-action="remove-from-cart"]')) {
            console.log('Remove from cart clicked');
            e.preventDefault();
            const productId = parseInt(e.target.dataset.productId);
            removeFromCart(productId);
        }
        
        if (e.target.matches('[data-action="toggle-favorite"]')) {
            console.log('Toggle favorite clicked');
            e.preventDefault();
            const productId = parseInt(e.target.dataset.productId);
            toggleFavorite(productId);
        }
    });
    
    // Добавляем валидацию форм
    document.addEventListener('submit', function(e) {
        if (e.target.matches('form[data-validate="true"]')) {
            if (!validateForm(e.target)) {
                e.preventDefault();
            }
        }
    });
});

// Экспортируем функции для использования в других скриптах
window.updateHeaderCounters = updateHeaderCounters;
window.updateHeaderCountersSimple = updateHeaderCountersSimple;
window.updateProductStatus = updateProductStatus;
window.addToCart = addToCart;
window.removeFromCart = removeFromCart;
window.toggleFavorite = toggleFavorite;
window.showNotification = showNotification;
window.validateEmail = validateEmail;
window.validatePhone = validatePhone;
window.validateForm = validateForm;
window.validateUrl = validateUrl;
window.validateName = validateName;
window.validateAddress = validateAddress;
window.validatePrice = validatePrice;
window.showFieldError = showFieldError;
window.clearFieldError = clearFieldError;
window.syncCartWithServer = syncCartWithServer;
window.syncFavoritesWithServer = syncFavoritesWithServer;

console.log('Functions exported to window:', {
    updateHeaderCounters: typeof window.updateHeaderCounters,
    updateHeaderCountersSimple: typeof window.updateHeaderCountersSimple,
    addToCart: typeof window.addToCart,
    toggleFavorite: typeof window.toggleFavorite,
    showNotification: typeof window.showNotification
});
