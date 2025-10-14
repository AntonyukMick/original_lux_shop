/**
 * Скрипт для исправления проблем с загрузкой изображений на Android
 * Принудительно обновляет кэш изображений и обеспечивает fallback
 */

// Функция для получения счетчиков с сервера
async function getServerCounters() {
    try {
        const response = await fetch('/api/counters');
        const data = await response.json();
        
        if (data.success) {
            console.log('📡 Получены счетчики с сервера:', data);
            return {
                favoritesCount: data.favorites_count,
                cartCount: data.cart_count
            };
        }
    } catch (error) {
        console.warn('❌ Ошибка получения счетчиков с сервера:', error);
    }
    
    // Fallback к localStorage
    const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    return {
        favoritesCount: favorites.length,
        cartCount: cart.length
    };
}

// Функция для синхронизации localStorage с сервером
async function syncWithServer() {
    try {
        const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        
        const response = await fetch('/api/sync', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                favorites: favorites,
                cart: cart
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            console.log('🔄 Синхронизация с сервером успешна:', data);
            return {
                favoritesCount: data.favorites_count,
                cartCount: data.cart_count
            };
        }
    } catch (error) {
        console.warn('❌ Ошибка синхронизации с сервером:', error);
    }
    
    return null;
}

// Функция для обновления счетчиков и скрытия пустых badges
async function updateHeaderCounters() {
    console.log('🔄 Обновление счетчиков хедера...');
    
    // Сначала пытаемся получить данные с сервера
    let counters = await getServerCounters();
    
    // Если есть данные в localStorage, синхронизируем с сервером
    const localFavorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    const localCart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    if (localFavorites.length > 0 || localCart.length > 0) {
        const syncResult = await syncWithServer();
        if (syncResult) {
            counters = syncResult;
        }
    }
    
    const favoritesCount = counters.favoritesCount;
    const cartCount = counters.cartCount;
    
    console.log(`📊 Счетчики: Избранное: ${favoritesCount}, Корзина: ${cartCount}`);
    
    // Обновляем все badges
    const badges = document.querySelectorAll('.badge');
    badges.forEach(badge => {
        if (badge.id === 'favorites-badge' || badge.classList.contains('mobile-favorites-badge')) {
            badge.textContent = favoritesCount;
            badge.setAttribute('data-count', favoritesCount);
            
            // Скрываем если пусто
            if (favoritesCount === 0) {
                badge.style.display = 'none';
            } else {
                badge.style.display = 'block';
            }
        }
        
        if (badge.id === 'cart-badge' || badge.classList.contains('mobile-cart-badge')) {
            badge.textContent = cartCount;
            badge.setAttribute('data-count', cartCount);
            
            // Скрываем если пусто
            if (cartCount === 0) {
                badge.style.display = 'none';
            } else {
                badge.style.display = 'block';
            }
        }
    });
}

// Функция для принудительного обновления изображений
function forceImageReload() {
    const images = document.querySelectorAll('.icon-image');
    console.log('🔄 Принудительное обновление изображений...', images.length);
    
    images.forEach((img, index) => {
        const originalSrc = img.src.split('?')[0]; // Убираем существующий параметр версии
        const newSrc = originalSrc + '?v=' + Date.now() + '&force=' + Math.random();
        
        console.log(`📸 Обновление изображения ${index + 1}:`, originalSrc);
        
        // Создаем новое изображение для предзагрузки
        const newImg = new Image();
        
        newImg.onload = function() {
            console.log('✅ Изображение загружено:', originalSrc);
            img.src = newSrc;
            img.style.display = 'block';
            // Скрываем fallback если он был показан
            const fallback = img.nextElementSibling;
            if (fallback && fallback.classList.contains('icon-fallback')) {
                fallback.style.display = 'none';
            }
        };
        
        newImg.onerror = function() {
            console.warn('❌ Ошибка загрузки изображения:', originalSrc);
            img.style.display = 'none';
            // Показываем fallback
            const fallback = img.nextElementSibling;
            if (fallback && fallback.classList.contains('icon-fallback')) {
                fallback.style.display = 'flex';
            }
        };
        
        newImg.src = newSrc;
    });
}

// Функция для проверки и исправления изображений
function checkAndFixImages() {
    const images = document.querySelectorAll('.icon-image');
    let brokenImages = 0;
    
    images.forEach(img => {
        if (!img.complete || img.naturalHeight === 0) {
            brokenImages++;
            console.warn('🔍 Найдено поврежденное изображение:', img.src);
            
            // Показываем fallback
            img.style.display = 'none';
            const fallback = img.nextElementSibling;
            if (fallback && fallback.classList.contains('icon-fallback')) {
                fallback.style.display = 'flex';
            }
        }
    });
    
    if (brokenImages > 0) {
        console.log(`🔧 Найдено ${brokenImages} поврежденных изображений, запускаем принудительное обновление...`);
        setTimeout(forceImageReload, 1000);
    }
}

// Функция для добавления обработчиков ошибок к изображениям
function addImageErrorHandlers() {
    const images = document.querySelectorAll('.icon-image');
    
    images.forEach(img => {
        img.addEventListener('error', function() {
            console.warn('❌ Ошибка загрузки изображения:', this.src);
            this.style.display = 'none';
            
            // Показываем fallback
            const fallback = this.nextElementSibling;
            if (fallback && fallback.classList.contains('icon-fallback')) {
                fallback.style.display = 'flex';
            }
        });
        
        img.addEventListener('load', function() {
            console.log('✅ Изображение успешно загружено:', this.src);
            this.style.display = 'block';
            
            // Скрываем fallback
            const fallback = this.nextElementSibling;
            if (fallback && fallback.classList.contains('icon-fallback')) {
                fallback.style.display = 'none';
            }
        });
    });
}

// Функция для определения Android устройства
function isAndroidDevice() {
    return /Android/i.test(navigator.userAgent) || 
           /Android/i.test(navigator.platform) ||
           window.Telegram?.WebApp?.platform === 'android';
}

// Основная функция инициализации
function initImageFix() {
    console.log('🚀 Инициализация исправления изображений...');
    console.log('📱 Платформа:', navigator.userAgent);
    console.log('🤖 Android устройство:', isAndroidDevice());
    
    // Добавляем обработчики ошибок
    addImageErrorHandlers();
    
    // Обновляем счетчики
    updateHeaderCounters();
    
    // Проверяем изображения после загрузки DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            checkAndFixImages();
            updateHeaderCounters();
        });
    } else {
        checkAndFixImages();
        updateHeaderCounters();
    }
    
    // Дополнительная проверка через 2 секунды (для медленных соединений)
    setTimeout(function() {
        checkAndFixImages();
        updateHeaderCounters();
    }, 2000);
    
    // Принудительное обновление для Android устройств
    if (isAndroidDevice()) {
        console.log('🤖 Android устройство обнаружено, применяем дополнительные исправления...');
        setTimeout(function() {
            forceImageReload();
            updateHeaderCounters();
        }, 3000);
    }
    
    // Обновляем счетчики при изменении localStorage
    window.addEventListener('storage', function(e) {
        if (e.key === 'favorites' || e.key === 'cart') {
            console.log('📦 Изменение в localStorage, обновляем счетчики...');
            updateHeaderCounters();
        }
    });
}

// Запускаем исправления
initImageFix();

// Экспортируем функции для глобального использования
window.forceImageReload = forceImageReload;
window.checkAndFixImages = checkAndFixImages;
window.updateHeaderCounters = updateHeaderCounters;
