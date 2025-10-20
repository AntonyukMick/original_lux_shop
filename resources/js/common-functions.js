/**
 * Общие функции для всего приложения
 * Централизованное место для избежания дублирования кода
 */

console.log('common-functions.js loaded');

/**
 * Обновляет счетчики в хедере (избранное и корзина)
 * Используется на всех страницах приложения
 */
async function updateHeaderCounters() {
    try {
        // Получаем данные корзины с сервера
        const cartResponse = await fetch('/cart/count');
        const cartData = await cartResponse.json();
        
        // Получаем данные избранного из localStorage (пока нет серверного API)
        const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        
        // Обновляем счетчик избранного
        const favoritesBadge = document.getElementById('favorites-badge');
        if (favoritesBadge) {
            if (favorites.length > 0) {
                favoritesBadge.textContent = favorites.length;
                favoritesBadge.classList.remove('hidden');
            } else {
                favoritesBadge.classList.add('hidden');
            }
        }
        
        // Обновляем счетчик корзины с сервера
        const cartBadge = document.getElementById('cart-badge');
        if (cartBadge) {
            if (cartData.count > 0) {
                cartBadge.textContent = cartData.count;
                cartBadge.classList.remove('hidden');
            } else {
                cartBadge.classList.add('hidden');
            }
        }
        
        // Обновляем мобильные счетчики
        const mobileCartBadge = document.querySelector('.mobile-cart-badge');
        if (mobileCartBadge) {
            if (cartData.count > 0) {
                mobileCartBadge.textContent = cartData.count;
                mobileCartBadge.classList.remove('hidden');
            } else {
                mobileCartBadge.classList.add('hidden');
            }
        }
        
        const mobileFavoritesBadge = document.querySelector('.mobile-favorites-badge');
        if (mobileFavoritesBadge) {
            if (favorites.length > 0) {
                mobileFavoritesBadge.textContent = favorites.length;
                mobileFavoritesBadge.classList.remove('hidden');
            } else {
                mobileFavoritesBadge.classList.add('hidden');
            }
        }
        
    } catch (error) {
        console.error('Error updating header counters:', error);
        
        // Fallback к localStorage в случае ошибки
        const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        
        const favoritesBadge = document.getElementById('favorites-badge');
        if (favoritesBadge) {
            if (favorites.length > 0) {
                favoritesBadge.textContent = favorites.length;
                favoritesBadge.classList.remove('hidden');
            } else {
                favoritesBadge.classList.add('hidden');
            }
        }
        
        const cartBadge = document.getElementById('cart-badge');
        if (cartBadge) {
            const totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
            if (totalItems > 0) {
                cartBadge.textContent = totalItems;
                cartBadge.classList.remove('hidden');
            } else {
                cartBadge.classList.add('hidden');
            }
        }
    }
}

/**
 * Простая версия обновления счетчиков для совместимости с home.blade.php
 * Использует тот же алгоритм, что и updateHeaderCounters
 */
async function updateHeaderCountersSimple() {
    await updateHeaderCounters();
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
 * Добавляет товар в корзину (только для авторизованных пользователей)
 * @param {number|string} productId - ID товара
 * @param {number} quantity - Количество (по умолчанию 1)
 */
async function addToCart(productId, quantity = 1) {
    console.log('addToCart called with:', { productId, quantity });
    
    // Проверяем авторизацию
    const auth = @json(session('auth'));
    if (!auth || !auth.id) {
        showNotification('Для добавления товара в корзину необходимо войти в систему', 'error');
        setTimeout(() => {
            window.location.href = '/login';
        }, 2000);
        return;
    }
    
    try {
        const response = await fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            showNotification('Товар добавлен в корзину', 'success');
            await updateHeaderCounters();
            updateProductStatus(productId, 'cart');
        } else {
            showNotification(data.message || 'Ошибка при добавлении товара', 'error');
        }
    } catch (error) {
        console.error('Ошибка при добавлении в корзину:', error);
        showNotification('Ошибка при добавлении товара в корзину', 'error');
    }
}

/**
 * Удаляет товар из корзины
 * @param {number|string} productId - ID товара или название
 * @param {string} title - Название товара (если используется title вместо ID)
 */
async function removeFromCart(productId, title = null) {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    let filteredCart;
    if (title) {
        filteredCart = cart.filter(item => item.title !== title);
    } else {
        filteredCart = cart.filter(item => item.id !== productId);
    }
    
    localStorage.setItem('cart', JSON.stringify(filteredCart));
    
    await updateHeaderCounters();
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
async function toggleFavorite(productId, title = null) {
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
    await updateHeaderCounters();
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
            console.log('🛒 Add to cart clicked');
            e.preventDefault();
            e.stopPropagation();
            
            const productId = parseInt(e.target.dataset.productId);
            const quantityInput = document.getElementById('quantity');
            const quantity = quantityInput ? parseInt(quantityInput.value) : parseInt(e.target.dataset.quantity) || 1;
            const size = e.target.dataset.size || '';
            
            console.log('🛒 Product data:', { productId, quantity, size });
            
            // Проверяем, находимся ли мы на странице товара
            if (window.location.pathname.includes('/product/')) {
                console.log('🛒 On product page, using addToCartNew');
                // На странице товара используем addToCartNew с полными данными
                const title = e.target.closest('.product-detail')?.querySelector('h1')?.textContent || 'Товар';
                const priceElement = e.target.closest('.product-detail')?.querySelector('.price');
                const price = priceElement ? parseFloat(priceElement.textContent.replace(/[^\d.,]/g, '').replace(',', '.')) : 0;
                const imageElement = e.target.closest('.product-detail')?.querySelector('.product-image img');
                const image = imageElement ? imageElement.src : '';
                
                console.log('🛒 Adding to cart from product page:', { productId, title, price, image, size, quantity });
                await addToCartNew(productId, title, price, image, size, quantity);
            } else {
                console.log('🛒 On other page, using addToCart');
                // На других страницах используем обычный addToCart
                console.log('🛒 Adding to cart from other page:', productId, quantity);
                await addToCart(productId, quantity);
            }
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
/**
 * Добавляет товар в корзину через API (новая версия)
 * @param {number} productId - ID товара
 * @param {string} title - Название товара
 * @param {number} price - Цена товара
 * @param {string} image - URL изображения товара
 * @param {string} size - Размер товара (опционально)
 * @param {number} quantity - Количество товара (по умолчанию 1)
 */
async function addToCartNew(productId, title, price, image, size = '', quantity = 1) {
    try {
        console.log('🛒 Adding to cart via PHP controller:', { productId, title, price, image, size, quantity });
        
        const response = await fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                product_id: productId,
                title: title,
                price: price,
                quantity: quantity,
                image: image,
                size: size
            })
        });
        
        console.log('🛒 Response status:', response.status);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        console.log('🛒 Response data:', data);
        
        if (data.success) {
            console.log('✅ Товар добавлен в корзину через PHP:', data);
            showNotification(data.message || 'Товар добавлен в корзину', 'success');
            
            // Обновляем счетчики
            await updateHeaderCounters();
            
            // Обновляем кнопку на "В корзине"
            const buttons = document.querySelectorAll(`[data-product-id="${productId}"]`);
            buttons.forEach(button => {
                if (button.classList.contains('add-to-cart-btn')) {
                    button.textContent = 'В корзине';
                    button.style.background = '#48bb78';
                    button.disabled = true;
                }
            });
        } else {
            console.error('❌ Ошибка добавления в корзину:', data);
            if (data.requires_auth) {
                showNotification('Для добавления товара в корзину необходимо войти в систему', 'error');
                setTimeout(() => {
                    window.location.href = '/login';
                }, 2000);
            } else {
                showNotification(data.message || 'Ошибка добавления в корзину', 'error');
            }
        }
    } catch (error) {
        console.error('❌ Ошибка при добавлении в корзину:', error);
        showNotification('Ошибка при добавлении товара в корзину', 'error');
    }
}

window.addToCart = addToCart;
window.addToCartNew = addToCartNew;
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
window.syncFavoritesWithServer = syncFavoritesWithServer;

console.log('Functions exported to window:', {
    updateHeaderCounters: typeof window.updateHeaderCounters,
    updateHeaderCountersSimple: typeof window.updateHeaderCountersSimple,
    addToCart: typeof window.addToCart,
    toggleFavorite: typeof window.toggleFavorite,
    showNotification: typeof window.showNotification
});
