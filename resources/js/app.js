import './bootstrap';
import './common-functions';

// Убеждаемся, что функции доступны глобально
console.log('app.js loaded');
console.log('Functions available:', {
    updateHeaderCounters: typeof window.updateHeaderCounters,
    addToCart: typeof window.addToCart,
    toggleFavorite: typeof window.toggleFavorite,
    showNotification: typeof window.showNotification
});
