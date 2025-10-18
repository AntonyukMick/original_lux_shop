/**
 * Cart Manager - Server-side cart functionality
 */
class CartManager {
    static init() {
        // НЕ загружаем корзину через API - данные уже загружены с сервера
        this.bindEvents();
        this.updateHeaderCounters();
    }

    static bindEvents() {
        // Bind modal events
        this.bindModalEvents();
    }

    static bindModalEvents() {
        // FAQ Modal
        const faqModal = document.getElementById('faqModal');
        if (faqModal) {
            faqModal.addEventListener('click', (e) => {
                if (e.target === faqModal) {
                    this.closeModal('faq');
                }
            });
        }
    }

    static async loadCart() {
        try {
            const response = await fetch('/cart/data');
            const data = await response.json();
            
            if (data.success) {
                this.displayCart(data.cart, data.total, data.count);
            } else {
                console.error('Error loading cart:', data.message);
                this.displayEmptyCart();
            }
        } catch (error) {
            console.error('Error loading cart:', error);
            this.displayEmptyCart();
        }
    }

    static displayCart(cartItems, total, count) {
        const cartContent = document.getElementById('cart-content');
        const cartSummary = document.getElementById('cart-summary');
        const cartItemsCount = document.getElementById('cart-items-count');
        
        if (!cartContent || !cartSummary || !cartItemsCount) return;

        if (cartItems.length === 0) {
            this.displayEmptyCart();
            return;
        }

        // Обновляем счетчик товаров
        cartItemsCount.textContent = `${count} товар${this.getPlural(count)}`;

        // Отображаем товары
        cartContent.innerHTML = cartItems.map(item => `
            <div class="cart-item" data-product-id="${item.id}" data-size="${item.size || ''}">
                <img src="${item.image || '/image/placeholder.jpg'}" alt="${item.title}" class="cart-item-image">
                <div class="cart-item-info">
                    <div class="cart-item-title">${item.title}</div>
                    <div class="cart-item-price">${item.price}€</div>
                    ${item.size ? `<div class="cart-item-size">Размер: ${item.size}</div>` : ''}
                </div>
                <div class="cart-item-quantity">
                    <button class="quantity-btn" onclick="CartManager.decreaseQuantity(${item.id}, '${item.size || ''}')">-</button>
                    <input type="number" class="quantity-input" value="${item.quantity}" min="1" max="10" 
                           onchange="CartManager.updateQuantity(${item.id}, '${item.size || ''}', this.value)">
                    <button class="quantity-btn" onclick="CartManager.increaseQuantity(${item.id}, '${item.size || ''}')">+</button>
                </div>
                <div class="cart-item-total">
                    ${(item.price * item.quantity).toFixed(2)}€
                </div>
                <button class="cart-item-remove" onclick="CartManager.removeFromCart(${item.id}, '${item.size || ''}')">×</button>
            </div>
        `).join('');

        // Обновляем итоговую сумму
        document.getElementById('cart-total').textContent = `${total.toFixed(2)}€`;

        // Показываем корзину
        cartSummary.style.display = 'block';
    }

    static displayEmptyCart() {
        const cartContent = document.getElementById('cart-content');
        const cartSummary = document.getElementById('cart-summary');
        const cartItemsCount = document.getElementById('cart-items-count');
        
        if (!cartContent || !cartSummary || !cartItemsCount) return;

        cartItemsCount.textContent = '0 товаров';
        cartContent.innerHTML = `
            <div class="cart-empty">
                <div class="cart-empty-icon">🛒</div>
                <h3 class="cart-empty-title">Корзина пуста</h3>
                <p class="cart-empty-description">Добавьте товары в корзину для оформления заказа</p>
                <a href="/" class="cart-empty-button">Перейти к каталогу</a>
            </div>
        `;
        cartSummary.style.display = 'none';
    }

    static async addToCart(productId, title, price, image, size = null) {
        try {
            const response = await fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    title: title,
                    price: price,
                    image: image,
                    size: size,
                    quantity: 1
                })
            });

            const data = await response.json();
            
            if (data.success) {
                this.showNotification('Товар добавлен в корзину', 'success');
                this.updateHeaderCounters();
                this.loadCart(); // Перезагружаем корзину
            } else {
                this.showNotification(data.message || 'Ошибка при добавлении товара', 'error');
            }
        } catch (error) {
            console.error('Error adding to cart:', error);
            this.showNotification('Ошибка при добавлении товара', 'error');
        }
    }

    static async updateQuantity(productId, size, quantity) {
        try {
            const response = await fetch('/cart/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    size: size,
                    quantity: parseInt(quantity)
                })
            });

            const data = await response.json();
            
            if (data.success) {
                this.updateHeaderCounters();
                this.loadCart(); // Перезагружаем корзину
            } else {
                this.showNotification(data.message || 'Ошибка при обновлении количества', 'error');
            }
        } catch (error) {
            console.error('Error updating quantity:', error);
            this.showNotification('Ошибка при обновлении количества', 'error');
        }
    }

    static async increaseQuantity(productId, size) {
        const input = document.querySelector(`[data-product-id="${productId}"][data-size="${size}"] input[type="number"]`);
        if (input) {
            const newQuantity = parseInt(input.value) + 1;
            if (newQuantity <= 10) {
                await this.updateQuantity(productId, size, newQuantity);
            }
        }
    }

    static async decreaseQuantity(productId, size) {
        const input = document.querySelector(`[data-product-id="${productId}"][data-size="${size}"] input[type="number"]`);
        if (input) {
            const newQuantity = parseInt(input.value) - 1;
            if (newQuantity >= 1) {
                await this.updateQuantity(productId, size, newQuantity);
            } else {
                await this.removeFromCart(productId, size);
            }
        }
    }

    static async removeFromCart(productId, size) {
        try {
            const response = await fetch('/cart/remove', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    size: size
                })
            });

            const data = await response.json();
            
            if (data.success) {
                this.showNotification('Товар удален из корзины', 'success');
                this.updateHeaderCounters();
                this.loadCart(); // Перезагружаем корзину
            } else {
                this.showNotification(data.message || 'Ошибка при удалении товара', 'error');
            }
        } catch (error) {
            console.error('Error removing from cart:', error);
            this.showNotification('Ошибка при удалении товара', 'error');
        }
    }

    static async clearCart() {
        try {
            const response = await fetch('/cart/clear', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const data = await response.json();
            
            if (data.success) {
                this.showNotification('Корзина очищена', 'success');
                this.updateHeaderCounters();
                this.loadCart(); // Перезагружаем корзину
            } else {
                this.showNotification(data.message || 'Ошибка при очистке корзины', 'error');
            }
        } catch (error) {
            console.error('Error clearing cart:', error);
            this.showNotification('Ошибка при очистке корзины', 'error');
        }
    }

    static async updateHeaderCounters() {
        try {
            const [countResponse, totalResponse] = await Promise.all([
                fetch('/cart/count'),
                fetch('/cart/total')
            ]);

            const countData = await countResponse.json();
            const totalData = await totalResponse.json();

            // Обновляем счетчики в хедере
            const cartBadge = document.getElementById('cart-badge');
            if (cartBadge) {
                cartBadge.textContent = countData.count;
                cartBadge.style.display = countData.count > 0 ? 'block' : 'none';
            }

            const mobileCartBadge = document.querySelector('.mobile-cart-badge');
            if (mobileCartBadge) {
                mobileCartBadge.textContent = countData.count;
                mobileCartBadge.style.display = countData.count > 0 ? 'block' : 'none';
            }
        } catch (error) {
            console.error('Error updating header counters:', error);
        }
    }

    static async enhancedCheckout() {
        try {
            const response = await fetch('/cart/data');
            const data = await response.json();
            
            if (!data.success || data.cart.length === 0) {
                alert('Корзина пуста');
                return;
            }

            // Переходим к улучшенной форме заказа
            window.location.href = '/enhanced-order';
        } catch (error) {
            console.error('Error during checkout:', error);
            alert('Ошибка при переходе к оформлению заказа');
        }
    }

    static showNotification(message, type = 'info') {
        // Простое уведомление
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.textContent = message;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 20px;
            border-radius: 6px;
            color: white;
            font-weight: 500;
            z-index: 10000;
            transition: all 0.3s ease;
            ${type === 'success' ? 'background: #10b981;' : 
              type === 'error' ? 'background: #ef4444;' : 
              'background: #3b82f6;'}
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    static getPlural(count) {
        if (count % 10 === 1 && count % 100 !== 11) return '';
        if ([2, 3, 4].includes(count % 10) && ![12, 13, 14].includes(count % 100)) return 'а';
        return 'ов';
    }

    static closeModal(modalId) {
        const modal = document.getElementById(modalId + 'Modal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }
}

// Global functions for backward compatibility
function addToCart(productId, title, price, image, size = null) {
    CartManager.addToCart(productId, title, price, image, size);
}

function enhancedCheckout() {
    CartManager.enhancedCheckout();
}

function checkout() {
    CartManager.enhancedCheckout();
}

function simpleCheckout() {
    CartManager.enhancedCheckout();
}