// Общие JavaScript функции для всех страниц
function showModal(type) {
    const modal = document.getElementById(type + 'Modal');
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
}

function closeModal() {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.style.display = 'none';
    });
    document.body.style.overflow = 'auto';
}

function showSubcategoriesModal(categoryId) {
    const modal = document.getElementById('subcategoriesModal');
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
        
        // Загружаем подкатегории для выбранной категории
        getSubcategoriesForCategory(categoryId);
    }
}

function getSubcategoriesForCategory(categoryId) {
    const subcategoriesContainer = document.getElementById('subcategoriesList');
    if (!subcategoriesContainer) return;
    
    // Здесь должна быть логика загрузки подкатегорий
    // Пока что просто очищаем контейнер
    subcategoriesContainer.innerHTML = '<p>Подкатегории для категории ' + categoryId + '</p>';
}

function selectSubcategory(subcategoryId, subcategoryName) {
    // Логика выбора подкатегории
    console.log('Выбрана подкатегория:', subcategoryId, subcategoryName);
    closeModal();
}

// Обработчик клика вне модального окна
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('modal')) {
        closeModal();
    }
});

// Обработчик нажатия Escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
});

// Функции для работы с корзиной и избранным
function addToCart(productId) {
    // Логика добавления в корзину
    console.log('Добавлено в корзину:', productId);
}

function addToFavorites(productId) {
    // Логика добавления в избранное
    console.log('Добавлено в избранное:', productId);
}

function removeFromCart(productId) {
    // Логика удаления из корзины
    console.log('Удалено из корзины:', productId);
}

function removeFromFavorites(productId) {
    // Логика удаления из избранного
    console.log('Удалено из избранного:', productId);
}

