/**
 * Cart Manager - Clean JavaScript for cart functionality
 */
class CartManager {
    static init() {
        this.loadCart();
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

    static loadCart() {
        const cart = this.getCart();
        const cartContent = document.getElementById('cart-content');
        const cartSummary = document.getElementById('cart-summary');
        const cartItemsCount = document.getElementById('cart-items-count');

        if (cart.length === 0) {
            this.showEmptyState(cartContent);
            cartSummary.style.display = 'none';
            cartItemsCount.textContent = '0 товаров';
            return;
        }

        this.renderCartItems(cart, cartContent);
        this.updateSummary(cart);
        cartSummary.style.display = 'block';
        cartItemsCount.textContent = `${cart.length} товар${this.getPluralForm(cart.length)}`;
    }

    static showEmptyState(container) {
        container.innerHTML = `
            <div class="cart-empty">
                <div class="cart-empty-icon">🛒</div>
                <h2 class="cart-empty-title">Корзина пуста</h2>
                <p class="cart-empty-description">Добавьте товары в корзину, чтобы они отобразились здесь</p>
                <a href="/catalog" class="cart-empty-button">
                    <span>🛍️</span>
                    Перейти к покупкам
                </a>
            </div>
        `;
    }

    static renderCartItems(cart, container) {
        let html = '';
        
        cart.forEach((item, index) => {
            const price = parseFloat(item.price) || 0;
            const quantity = parseInt(item.quantity) || 1;
            const total = price * quantity;

            html += `
                <div class="cart-item">
                    <img src="${item.image}" alt="${item.title}" class="cart-item-image">
                    <div class="cart-item-info">
                        <h3 class="cart-item-title">${item.title}</h3>
                        <div class="cart-item-price">${price.toFixed(2)}€</div>
                    </div>
                    <div class="cart-item-quantity">
                        <input type="number" 
                               class="quantity-input" 
                               value="${quantity}" 
                               min="1" 
                               max="99" 
                               onchange="CartManager.updateQuantity(${index}, this.value)">
                    </div>
                    <div class="cart-item-total">${total.toFixed(2)}€</div>
                    <button class="cart-item-remove" onclick="CartManager.removeItem(${index})">
                        ✕
                    </button>
                </div>
            `;
        });

        container.innerHTML = html;
    }

    static updateSummary(cart) {
        const total = cart.reduce((sum, item) => {
            const price = parseFloat(item.price) || 0;
            const quantity = parseInt(item.quantity) || 1;
            return sum + (price * quantity);
        }, 0);

        document.getElementById('cart-total').textContent = `${total.toFixed(2)}€`;
    }

    static updateQuantity(index, quantity) {
        const cart = this.getCart();
        if (cart[index] && quantity > 0) {
            cart[index].quantity = parseInt(quantity);
            localStorage.setItem('cart', JSON.stringify(cart));
            this.loadCart();
            this.updateHeaderCounters();
        }
    }

    static removeItem(index) {
        if (confirm('Удалить товар из корзины?')) {
            const cart = this.getCart();
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            this.loadCart();
            this.updateHeaderCounters();
        }
    }

    static clearCart() {
        localStorage.removeItem('cart');
        this.loadCart();
        this.updateHeaderCounters();
    }

    static async checkout() {
        const cart = this.getCart();
        if (cart.length === 0) {
            alert('Корзина пуста');
            return;
        }

        // Создаем форму и отправляем заказ напрямую
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/simple-order';
        
        // CSRF Token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        const metaToken = document.querySelector('meta[name="csrf-token"]');
        csrfToken.value = metaToken ? metaToken.getAttribute('content') : '';
        form.appendChild(csrfToken);
        
        // Данные корзины
        const cartInput = document.createElement('input');
        cartInput.type = 'hidden';
        cartInput.name = 'cart_data';
        cartInput.value = JSON.stringify(cart);
        form.appendChild(cartInput);
        
        // Добавляем форму на страницу и отправляем
        document.body.appendChild(form);
        form.submit();
    }

    static async simpleCheckout() {
        const cart = this.getCart();
        if (cart.length === 0) {
            alert('Корзина пуста');
            return;
        }

        // Создаем форму и отправляем заказ напрямую
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/simple-order';
        
        // CSRF Token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        const metaToken = document.querySelector('meta[name="csrf-token"]');
        csrfToken.value = metaToken ? metaToken.getAttribute('content') : '';
        form.appendChild(csrfToken);
        
        // Данные корзины
        const cartInput = document.createElement('input');
        cartInput.type = 'hidden';
        cartInput.name = 'cart_data';
        cartInput.value = JSON.stringify(cart);
        form.appendChild(cartInput);
        
        // Добавляем форму на страницу и отправляем
        document.body.appendChild(form);
        form.submit();
    }

    static async syncCartWithServer(cart) {
        // Получаем CSRF токен безопасным способом
        const metaToken = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = metaToken ? metaToken.getAttribute('content') : this.getCsrfTokenFromCookie();
        
        const response = await fetch('/cart/sync', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken || ''
            },
            body: JSON.stringify({ cart })
        });

        if (!response.ok) {
            throw new Error('Sync failed');
        }
    }

    static createCheckoutForm(cart) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/generate-order-pdf';
        
        // CSRF Token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        
        // Попробуем получить CSRF токен из meta тега
        const metaToken = document.querySelector('meta[name="csrf-token"]');
        if (metaToken) {
            csrfToken.value = metaToken.getAttribute('content');
        } else {
            // Альтернативный способ - получить из cookie
            const token = this.getCsrfTokenFromCookie();
            csrfToken.value = token || '';
        }
        
        form.appendChild(csrfToken);
        
        // Cart Items
        const cartItemsInput = document.createElement('input');
        cartItemsInput.type = 'hidden';
        cartItemsInput.name = 'cartItems';
        cartItemsInput.value = JSON.stringify(cart);
        form.appendChild(cartItemsInput);
        
        // Total Amount
        const totalInput = document.createElement('input');
        totalInput.type = 'hidden';
        totalInput.name = 'totalAmount';
        totalInput.value = this.calculateTotal(cart);
        form.appendChild(totalInput);
        
        return form;
    }

    static calculateTotal(cart) {
        return cart.reduce((total, item) => {
            const price = parseFloat(item.price) || 0;
            const quantity = parseInt(item.quantity) || 1;
            return total + (price * quantity);
        }, 0);
    }

    static updateHeaderCounters() {
        const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
        const cart = this.getCart();
        
        // Desktop counters
        this.updateCounter('favorites-badge', favorites.length);
        this.updateCounter('cart-badge', cart.reduce((sum, item) => sum + (item.quantity || 1), 0));
        
        // Mobile counters
        this.updateCounter('.mobile-favorites-badge', favorites.length);
        this.updateCounter('.mobile-cart-badge', cart.reduce((sum, item) => sum + (item.quantity || 1), 0));
    }

    static updateCounter(selector, count) {
        const element = typeof selector === 'string' && selector.startsWith('.') 
            ? document.querySelector(selector) 
            : document.getElementById(selector);
            
        if (element) {
            element.textContent = count;
            element.style.display = count > 0 ? 'block' : 'none';
        }
    }

    static getCsrfTokenFromCookie() {
        const cookies = document.cookie.split(';');
        for (let cookie of cookies) {
            const [name, value] = cookie.trim().split('=');
            if (name === 'XSRF-TOKEN') {
                return decodeURIComponent(value);
            }
        }
        return null;
    }

    static getCart() {
        return JSON.parse(localStorage.getItem('cart') || '[]');
    }

    static getPluralForm(count) {
        if (count % 10 === 1 && count % 100 !== 11) return '';
        if ([2, 3, 4].includes(count % 10) && ![12, 13, 14].includes(count % 100)) return 'а';
        return 'ов';
    }

    static showModal(type) {
        const modal = document.getElementById(`modal-${type}`);
        if (modal) {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
    }

    static closeModal(type) {
        const modal = document.getElementById(`modal-${type}`);
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }
}

// Global functions for backward compatibility
function checkout() {
    CartManager.checkout();
}

function simpleCheckout() {
    CartManager.simpleCheckout();
}

function updateQuantity(index, quantity) {
    CartManager.updateQuantity(index, quantity);
}

function removeFromCart(index) {
    CartManager.removeItem(index);
}

function clearCart() {
    CartManager.clearCart();
}

function showModal(type) {
    CartManager.showModal(type);
}

function closeModal(type) {
    CartManager.closeModal(type);
}

function updateHeaderCounters() {
    CartManager.updateHeaderCounters();
}
