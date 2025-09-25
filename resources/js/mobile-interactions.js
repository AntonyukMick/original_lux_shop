/* ======================================
   МОБИЛЬНЫЕ ВЗАИМОДЕЙСТВИЯ И TOUCH-СОБЫТИЯ
   ====================================== */

// Определение мобильного устройства
const isMobile = () => {
    return window.innerWidth <= 768 || /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
};

// Определение touch-устройства
const isTouchDevice = () => {
    return 'ontouchstart' in window || navigator.maxTouchPoints > 0;
};

// Инициализация мобильных взаимодействий
document.addEventListener('DOMContentLoaded', function() {
    if (isMobile()) {
        initMobileInteractions();
        initTouchGestures();
        initMobileOptimizations();
    }
});

// Основные мобильные взаимодействия
function initMobileInteractions() {
    // Улучшенный тап для кнопок
    enhanceButtonTaps();
    
    // Swipe-навигация для каруселей
    initSwipeCarousels();
    
    // Pull-to-refresh (если нужно)
    // initPullToRefresh();
    
    // Оптимизация скролла
    optimizeScrolling();
    
    // Виртуальная клавиатура
    handleVirtualKeyboard();
}

// Улучшение тапов по кнопкам
function enhanceButtonTaps() {
    const buttons = document.querySelectorAll('.btn, .product-btn, .favorite-btn, .icon-container');
    
    buttons.forEach(button => {
        // Убираем задержку в 300ms на iOS
        button.style.touchAction = 'manipulation';
        
        // Добавляем тактильную обратную связь
        button.addEventListener('touchstart', function(e) {
            if (navigator.vibrate) {
                navigator.vibrate(10); // Короткая вибрация
            }
            this.classList.add('touched');
        });
        
        button.addEventListener('touchend', function(e) {
            this.classList.remove('touched');
        });
        
        button.addEventListener('touchcancel', function(e) {
            this.classList.remove('touched');
        });
    });
}

// Swipe-навигация для каруселей
function initSwipeCarousels() {
    const carousels = document.querySelectorAll('.products-carousel, .carousel');
    
    carousels.forEach(carousel => {
        let startX = 0;
        let scrollLeft = 0;
        let isDown = false;
        
        carousel.addEventListener('touchstart', (e) => {
            isDown = true;
            startX = e.touches[0].pageX - carousel.offsetLeft;
            scrollLeft = carousel.scrollLeft;
            carousel.style.scrollBehavior = 'auto';
        });
        
        carousel.addEventListener('touchmove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.touches[0].pageX - carousel.offsetLeft;
            const walk = (x - startX) * 2;
            carousel.scrollLeft = scrollLeft - walk;
        });
        
        carousel.addEventListener('touchend', () => {
            isDown = false;
            carousel.style.scrollBehavior = 'smooth';
            
            // Snap to closest item
            snapToClosestItem(carousel);
        });
    });
}

// Привязка к ближайшему элементу в карусели
function snapToClosestItem(carousel) {
    const items = carousel.querySelectorAll('.product-card, .carousel-item');
    if (items.length === 0) return;
    
    const itemWidth = items[0].offsetWidth + 16; // включая gap
    const scrollLeft = carousel.scrollLeft;
    const snapIndex = Math.round(scrollLeft / itemWidth);
    
    carousel.scrollTo({
        left: snapIndex * itemWidth,
        behavior: 'smooth'
    });
}

// Touch-жесты
function initTouchGestures() {
    let touchStartX = 0;
    let touchStartY = 0;
    
    document.addEventListener('touchstart', (e) => {
        touchStartX = e.touches[0].clientX;
        touchStartY = e.touches[0].clientY;
    });
    
    document.addEventListener('touchmove', (e) => {
        if (!touchStartX || !touchStartY) return;
        
        const touchEndX = e.touches[0].clientX;
        const touchEndY = e.touches[0].clientY;
        
        const diffX = touchStartX - touchEndX;
        const diffY = touchStartY - touchEndY;
        
        // Определяем направление свайпа
        if (Math.abs(diffX) > Math.abs(diffY)) {
            // Горизонтальный свайп
            if (Math.abs(diffX) > 50) {
                if (diffX > 0) {
                    // Свайп влево
                    handleSwipeLeft(e.target);
                } else {
                    // Свайп вправо  
                    handleSwipeRight(e.target);
                }
            }
        } else {
            // Вертикальный свайп
            if (Math.abs(diffY) > 50) {
                if (diffY > 0) {
                    // Свайп вверх
                    handleSwipeUp(e.target);
                } else {
                    // Свайп вниз
                    handleSwipeDown(e.target);
                }
            }
        }
        
        touchStartX = 0;
        touchStartY = 0;
    });
}

// Обработчики свайпов
function handleSwipeLeft(target) {
    // Можно добавить логику для навигации
    console.log('Swipe left detected');
}

function handleSwipeRight(target) {
    // Можно добавить логику для навигации назад
    console.log('Swipe right detected');
}

function handleSwipeUp(target) {
    // Можно добавить логику для прокрутки
    console.log('Swipe up detected');
}

function handleSwipeDown(target) {
    // Можно добавить логику для обновления
    console.log('Swipe down detected');
}

// Оптимизация скролла
function optimizeScrolling() {
    // Плавный скролл для iOS
    document.documentElement.style.webkitOverflowScrolling = 'touch';
    
    // Предотвращение отскока на iOS
    document.body.addEventListener('touchmove', (e) => {
        if (e.target === document.body) {
            e.preventDefault();
        }
    }, { passive: false });
}

// Обработка виртуальной клавиатуры
function handleVirtualKeyboard() {
    const inputs = document.querySelectorAll('input, textarea');
    
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            // Прокручиваем к элементу при появлении клавиатуры
            setTimeout(() => {
                input.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'center' 
                });
            }, 300);
        });
        
        // Предотвращаем zoom при фокусе на iOS
        if (/iPhone|iPad/i.test(navigator.userAgent)) {
            input.addEventListener('focus', () => {
                const viewport = document.querySelector('meta[name=viewport]');
                viewport.setAttribute('content', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no');
            });
            
            input.addEventListener('blur', () => {
                const viewport = document.querySelector('meta[name=viewport]');
                viewport.setAttribute('content', 'width=device-width, initial-scale=1, user-scalable=no');
            });
        }
    });
}

// Мобильные оптимизации
function initMobileOptimizations() {
    // Lazy loading изображений
    initLazyLoading();
    
    // Оптимизация анимаций
    optimizeAnimations();
    
    // Управление памятью
    optimizeMemory();
}

// Lazy loading изображений
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px 0px'
        });
        
        images.forEach(img => imageObserver.observe(img));
    } else {
        // Fallback для старых браузеров
        images.forEach(img => {
            img.src = img.dataset.src;
            img.classList.add('loaded');
        });
    }
}

// Оптимизация анимаций для мобильных
function optimizeAnimations() {
    // Отключаем анимации при низком заряде батареи
    if ('getBattery' in navigator) {
        navigator.getBattery().then(battery => {
            if (battery.level < 0.2) {
                document.documentElement.classList.add('reduce-motion');
            }
        });
    }
    
    // Отключаем анимации при медленном соединении
    if ('connection' in navigator) {
        const connection = navigator.connection;
        if (connection.effectiveType === 'slow-2g' || connection.effectiveType === '2g') {
            document.documentElement.classList.add('reduce-motion');
        }
    }
}

// Управление памятью
function optimizeMemory() {
    // Очистка неиспользуемых элементов при прокрутке
    let scrollTimeout;
    window.addEventListener('scroll', () => {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            // Удаляем невидимые изображения из DOM если нужно
            optimizeOffscreenContent();
        }, 1000);
    });
}

// Оптимизация контента за экраном
function optimizeOffscreenContent() {
    const images = document.querySelectorAll('img.loaded');
    
    images.forEach(img => {
        const rect = img.getBoundingClientRect();
        const isOffscreen = rect.bottom < -200 || rect.top > window.innerHeight + 200;
        
        if (isOffscreen && img.src !== img.dataset.placeholder) {
            // Заменяем на placeholder если далеко за экраном
            img.dataset.originalSrc = img.src;
            img.src = img.dataset.placeholder || 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMSIgaGVpZ2h0PSIxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9IiNjY2MiLz48L3N2Zz4=';
        }
    });
}

// Утилиты для мобильных устройств
const MobileUtils = {
    // Проверка ориентации
    isPortrait: () => window.innerHeight > window.innerWidth,
    isLandscape: () => window.innerWidth > window.innerHeight,
    
    // Получение размеров экрана
    getScreenSize: () => ({
        width: window.innerWidth,
        height: window.innerHeight,
        availWidth: window.screen.availWidth,
        availHeight: window.screen.availHeight
    }),
    
    // Определение типа устройства
    getDeviceType: () => {
        const width = window.innerWidth;
        if (width <= 480) return 'mobile-portrait';
        if (width <= 768) return 'mobile-landscape';
        if (width <= 1024) return 'tablet';
        return 'desktop';
    },
    
    // Вибрация (если поддерживается)
    vibrate: (pattern = 10) => {
        if ('vibrate' in navigator) {
            navigator.vibrate(pattern);
        }
    },
    
    // Уведомления
    showMobileNotification: (message, type = 'info') => {
        const notification = document.createElement('div');
        notification.className = `mobile-notification mobile-notification-${type}`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }
};

// Обработка изменения ориентации
window.addEventListener('orientationchange', () => {
    setTimeout(() => {
        // Пересчитываем размеры после поворота
        const event = new CustomEvent('mobileOrientationChange', {
            detail: {
                orientation: MobileUtils.isPortrait() ? 'portrait' : 'landscape',
                deviceType: MobileUtils.getDeviceType()
            }
        });
        document.dispatchEvent(event);
    }, 100);
});

// Экспорт для использования в других модулях
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { MobileUtils, isMobile, isTouchDevice };
} else {
    window.MobileUtils = MobileUtils;
    window.isMobile = isMobile;
    window.isTouchDevice = isTouchDevice;
}

