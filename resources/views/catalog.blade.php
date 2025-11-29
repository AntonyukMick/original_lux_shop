@extends('layouts.app')

@section('title', isset($gender) && $gender === 'men' ? 'Мужской каталог' : (isset($gender) && $gender === 'women' ? 'Женский каталог' : 'Каталог товаров'))

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    :root { --bg:#f1f5f9; --card:#ffffff; --muted:#e2e8f0; --text:#0f172a; --accent:#527ea6; }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { 
        font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, 'Helvetica Neue', Arial, "Noto Sans", sans-serif; 
        background: var(--bg); 
        color: var(--text); 
        line-height: 1.6;
    }
    
    /* Улучшенные стили для поиска в каталоге */
    .search-section {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .search-section:hover {
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }
        
        .search-section input:focus {
            outline: none;
            border-color: #527ea6;
            box-shadow: 0 0 0 3px rgba(82, 126, 166, 0.1);
        }
        
        .search-section .search-btn:hover {
            background: #3b5a7a;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .search-section .search-filter:hover {
            background: #f1f5f9;
            border-color: #527ea6;
            color: #527ea6;
        }
        
        .search-section .search-filter.active {
            background: #527ea6;
            border-color: #527ea6;
            color: #fff;
            font-weight: 600;
        }
        
    .container {
        max-width: 1140px;
        margin: 0 auto;
        padding: 12px;
    }
    
    .main {
        padding-top: 50px;
        padding-bottom: 16px;
    }
    
    @media (min-width: 769px) {
        .main {
            padding-top: 40px;
        }
    }
    
    .catalog-header {
        text-align: center;
        margin-bottom: 16px;
    }
    
    .catalog-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 12px;
        color: var(--text);
        background: linear-gradient(135deg, #527ea6, #3b82f6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .catalog-subtitle {
        font-size: 16px;
        color: #475569;
        max-width: 600px;
        margin: 0 auto;
    }
        
        /* Category Tabs */
        .category-tabs {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-bottom: 32px;
            flex-wrap: wrap;
        }
        
        /* Мобильная адаптация для категорий */
        @media (max-width:768px){
            .category-tabs{gap:4px;margin-bottom:20px;justify-content:flex-start;overflow-x:auto;-webkit-overflow-scrolling:touch;padding-bottom:4px}
            .category-tab{padding:6px 10px;font-size:12px;border-radius:4px;white-space:nowrap;flex-shrink:0}
        }
        
        @media (max-width:480px){
            .category-tabs{gap:3px;margin-bottom:16px;padding-bottom:4px}
            .category-tab{padding:5px 8px;font-size:11px;border-radius:3px}
        }
        
        .category-tab {
            padding: 8px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            background: #fff;
            color: #0f172a;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s;
            cursor: pointer;
        }
        
        .category-tab:hover {
            border-color: #527ea6;
            color: #527ea6;
        }
        
        .category-tab.active {
            background: #527ea6;
            color: #fff;
            border-color: #527ea6;
        }
        
        /* Filters */
        .filters-section {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        
        .filters-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        
        .filters-title {
            font-size: 16px;
            font-weight: 600;
            color: #0f172a;
        }
        
        .reset-filters {
            color: #527ea6;
            text-decoration: none;
            font-size: 12px;
            cursor: pointer;
        }
        
        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        
        .filter-label {
            font-weight: 500;
            color: #0f172a;
            font-size: 12px;
        }
        
        .filter-select {
            height: 32px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 0 8px;
            background: #fff;
            font-size: 12px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .price-inputs {
            display: flex;
            gap: 6px;
        }
        
        .price-input {
            flex: 1;
            height: 32px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 0 8px;
            font-size: 12px;
            min-width: 0;
        }
        
        /* Мобильная адаптация для фильтров */
        @media (max-width:768px){
            .filters-section{padding:8px;margin-bottom:16px}
            .filters-header{margin-bottom:8px}
            .filters-title{font-size:14px}
            .reset-filters{font-size:11px}
            .filters-grid{grid-template-columns:1fr;gap:8px}
            .filter-group{gap:4px}
            .filter-label{font-size:11px}
            .filter-select{height:28px;font-size:11px;padding:0 6px}
            .price-inputs{gap:4px}
            .price-input{height:28px;font-size:11px;padding:0 6px}
        }
        
        @media (max-width:480px){
            .filters-section{padding:6px;margin-bottom:12px}
            .filters-header{margin-bottom:6px}
            .filters-title{font-size:13px}
            .reset-filters{font-size:10px}
            .filters-grid{gap:6px}
            .filter-group{gap:3px}
            .filter-label{font-size:10px}
            .filter-select{height:26px;font-size:10px;padding:0 5px}
            .price-inputs{gap:3px}
            .price-input{height:26px;font-size:10px;padding:0 5px}
        }
        
        /* Products Grid */
        .products-section {
            margin-bottom: 40px;
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .section-count {
            background: #e2e8f0;
            color: #64748b;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 14px;
            margin-bottom: 32px;
            align-items: stretch;
        }
        
        /* Мобильная адаптация для товаров каталога */
        @media (max-width:768px){
            .products-grid{grid-template-columns:repeat(2,1fr);gap:8px;align-items:stretch}
        }
        
        @media (max-width:480px){
            .products-grid{grid-template-columns:repeat(2,1fr);gap:6px;align-items:stretch}
        }
        
        @media (min-width:900px){
            .products-grid{grid-template-columns:repeat(2,1fr);align-items:stretch}
        }
        
        .product-card {
            background: #fff;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 12px;
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 320px;
        }
        
        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .product-link {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            text-decoration: none;
            color: inherit;
        }
        
        .product-image {
            width: 100%;
            border-radius: 8px;
            aspect-ratio: 4/3;
            object-fit: cover;
            background: #f1f5f9;
            flex-shrink: 0;
        }
        
        .product-info {
            margin: 8px 0 0 0;
            font-size: 12px;
            color: #475569;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 60px;
        }
        
        .product-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text);
            font-size: 12px;
            line-height: 1.4;
            flex-shrink: 0;
            flex-grow: 0;
        }
        
        .product-meta {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin: 8px 0 10px 0;
            font-size: 12px;
            color: #475569;
            flex-shrink: 0;
            flex-grow: 0;
        }
        
        .product-brand {
            font-size: 12px;
            color: #475569;
            font-weight: 500;
        }
        
        .product-price {
            font-weight: 700;
            color: #0f172a;
            font-size: 12px;
        }
        
        .product-actions {
            margin-top: auto;
            flex-shrink: 0;
            padding-top: 8px;
        }
        
        .add-to-cart-btn {
            height: 36px;
            padding: 0 16px;
            border-radius: 18px;
            border: 1px solid #e2e8f0;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            color: #475569;
            font-weight: 500;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            width: 100%;
        }
        
        .add-to-cart-btn:hover {
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
            color: #1e293b;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
        }
        
        .add-to-cart-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        /* Стили для кнопки "В корзине" */
        .add-to-cart-btn[style*="background:#48bb78"], 
        .add-to-cart-btn[style*="background: #48bb78"] {
            background: #48bb78 !important;
            color: #ffffff !important;
            font-weight: 600;
        }
        
        .add-to-cart-btn[style*="background:#48bb78"]:hover, 
        .add-to-cart-btn[style*="background: #48bb78"]:hover {
            background: #38a169 !important;
        }
        
        .favorite-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 28px;
            height: 28px;
            border: none;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            cursor: pointer;
            font-size: 14px;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        
        .favorite-btn:hover {
            background: rgba(255, 255, 255, 1);
            transform: scale(1.1);
        }
        
        /* Мобильная адаптация для карточек каталога */
        @media (max-width:768px){
            .products-grid{grid-template-columns:repeat(2,1fr);gap:8px;align-items:stretch}
            .product-card{padding:8px;border-radius:8px;min-height:280px}
            .product-image{border-radius:6px;aspect-ratio:1/1;flex-shrink:0}
            .product-info{flex-grow:1;min-height:70px;justify-content:space-between}
            .product-meta{font-size:11px;margin:6px 0 8px 0;gap:8px;flex-shrink:0;flex-grow:0}
            .product-price{font-size:13px;flex-shrink:0}
            .product-title{font-size:11px;margin-bottom:6px;flex-shrink:0;flex-grow:0}
            .product-actions{margin-top:auto;flex-shrink:0}
            .add-to-cart-btn{height:28px;padding:0 12px;font-size:11px;border-radius:14px}
            .favorite-btn{width:24px;height:24px;font-size:12px;top:6px;right:6px}
        }
        
        @media (max-width:480px){
            .products-grid{grid-template-columns:repeat(2,1fr);gap:6px;align-items:stretch}
            .product-card{padding:6px;border-radius:6px;min-height:240px}
            .product-image{border-radius:4px;aspect-ratio:1/1;flex-shrink:0}
            .product-info{flex-grow:1;min-height:60px;justify-content:space-between}
            .product-meta{font-size:10px;margin:4px 0 6px 0;gap:6px;flex-direction:column;align-items:flex-start;flex-shrink:0;flex-grow:0}
            .product-meta > div:first-child{line-height:1.2;margin-bottom:2px}
            .product-price{font-size:12px;font-weight:600;flex-shrink:0}
            .product-title{font-size:10px;margin-bottom:4px;flex-shrink:0;flex-grow:0}
            .product-actions{margin-top:auto;flex-shrink:0}
            .add-to-cart-btn{height:24px;padding:0 8px;font-size:10px;border-radius:12px}
            .favorite-btn{width:20px;height:20px;font-size:10px;top:4px;right:4px}
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .main {
                padding-top: 50px;
                padding-bottom: 12px;
            }
            
            .search-section {
                margin: 6px 0 !important;
                padding: 12px !important;
            }
            
            .search-section h3 {
                font-size: 14px !important;
                margin-bottom: 8px !important;
            }
            
            .search input {
                height: 36px !important;
                font-size: 13px !important;
                padding: 0 10px !important;
            }
            
            .search-btn {
                height: 36px !important;
                padding: 0 12px !important;
                font-size: 13px !important;
            }
            
            .category-tabs {
                justify-content: flex-start;
                overflow-x: auto;
                padding-bottom: 6px;
                -webkit-overflow-scrolling: touch;
                gap: 4px;
                margin-bottom: 20px;
            }
            
            .category-tab {
                flex-shrink: 0;
                white-space: nowrap;
                padding: 6px 10px;
                font-size: 12px;
            }
            
            .filters-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 480px) {
            .main {
                padding-top: 50px;
                padding-bottom: 8px;
            }
            
            .search-section {
                margin: 4px 0 !important;
                padding: 10px !important;
            }
            
            .search-section h3 {
                font-size: 13px !important;
                margin-bottom: 6px !important;
            }
            
            .search input {
                height: 32px !important;
                font-size: 12px !important;
                padding: 0 8px !important;
            }
            
            .search-btn {
                height: 32px !important;
                padding: 0 10px !important;
                font-size: 12px !important;
            }
        }
        
        /* Модальное окно подкатегорий */
        .subcategory-modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 2000;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .subcategory-modal-overlay.active {
            display: flex;
            opacity: 1;
        }
        
        .subcategory-modal {
            background: #fff;
            border-radius: 16px;
            width: 100%;
            max-width: 600px;
            max-height: 85vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
            transform: scale(0.9) translateY(20px);
            transition: transform 0.3s ease;
        }
        
        .subcategory-modal-overlay.active .subcategory-modal {
            transform: scale(1) translateY(0);
        }
        
        .subcategory-modal-header {
            padding: 24px;
            background: linear-gradient(135deg, #527ea6 0%, #3b82f6 100%);
            color: #fff;
            position: relative;
            border-radius: 16px 16px 0 0;
        }
        
        .subcategory-modal-title {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .subcategory-modal-subtitle {
            margin: 8px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
            font-weight: 400;
        }
        
        .subcategory-modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            border: none;
            background: rgba(255, 255, 255, 0.2);
            font-size: 28px;
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s ease;
            line-height: 1;
        }
        
        .subcategory-modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg) scale(1.1);
        }
        
        .subcategory-modal-body {
            padding: 24px;
            overflow-y: auto;
            flex: 1;
        }
        
        .subcategory-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 12px;
        }
        
        .subcategory-item {
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            border: 2px solid #cbd5e1;
            border-radius: 12px;
            padding: 20px 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }
        
        .subcategory-item::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #527ea6 0%, #3b82f6 100%);
            opacity: 0;
            transition: opacity 0.25s ease;
        }
        
        .subcategory-item:hover {
            border-color: #527ea6;
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 12px 24px rgba(82, 126, 166, 0.25);
        }
        
        .subcategory-item:hover::before {
            opacity: 0.08;
        }
        
        .subcategory-item:active {
            transform: translateY(-2px) scale(0.98);
        }
        
        .subcategory-icon {
            font-size: 36px;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
            display: inline-block;
            transition: transform 0.25s ease;
        }
        
        .subcategory-item:hover .subcategory-icon {
            transform: scale(1.15) rotate(5deg);
        }
        
        .subcategory-name {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            position: relative;
            z-index: 1;
            line-height: 1.3;
        }
        
        @media (max-width: 768px) {
            .subcategory-modal-overlay {
                padding: 12px;
            }
            
            .subcategory-modal {
                max-width: 100%;
                max-height: 90vh;
                border-radius: 12px;
            }
            
            .subcategory-modal-header {
                padding: 20px;
                border-radius: 12px 12px 0 0;
            }
            
            .subcategory-modal-title {
                font-size: 20px;
                gap: 8px;
            }
            
            .subcategory-modal-subtitle {
                font-size: 12px;
                margin-top: 6px;
            }
            
            .subcategory-modal-close {
                width: 36px;
                height: 36px;
                top: 16px;
                right: 16px;
                font-size: 24px;
            }
            
            .subcategory-modal-body {
                padding: 16px;
            }
            
            .subcategory-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                gap: 10px;
            }
            
            .subcategory-item {
                padding: 16px 12px;
                border-radius: 10px;
            }
            
            .subcategory-icon {
                font-size: 30px;
                margin-bottom: 8px;
            }
            
            .subcategory-name {
                font-size: 12px;
            }
        }
        
        @media (max-width: 480px) {
            .subcategory-modal-overlay {
                padding: 8px;
            }
            
            .subcategory-modal-title {
                font-size: 18px;
                gap: 6px;
            }
            
            .subcategory-modal-subtitle {
                font-size: 11px;
            }
            
            .subcategory-modal-close {
                width: 32px;
                height: 32px;
                font-size: 20px;
            }
            
            .subcategory-modal-body {
                padding: 12px;
            }
            
            .subcategory-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
            }
            
            .subcategory-item {
                padding: 14px 10px;
                border-radius: 8px;
            }
            
            .subcategory-icon {
                font-size: 26px;
                margin-bottom: 6px;
            }
            
            .subcategory-name {
                font-size: 11px;
            }
        }
    </style>
@endsection

@section('content')
<main class="main">
    <div class="container">
            <div class="catalog-header">
                <h1 class="catalog-title">
                    @if(isset($gender) && $gender === 'men')
                        Мужской каталог
                    @elseif(isset($gender) && $gender === 'women')
                        Женский каталог
                    @else
                        Каталог товаров
                    @endif
                </h1>
                <p class="catalog-subtitle">
                    @if(isset($gender) && $gender === 'men')
                        Товары для мужчин
                    @elseif(isset($gender) && $gender === 'women')
                        Товары для женщин
                    @else
                        Более 30 товаров в разных категориях
                    @endif
                </p>
            </div>

            <!-- Category Tabs -->
            <div class="category-tabs">
                <div class="category-tab active" data-category="all">Все товары</div>
                <div class="category-tab" data-category="Обувь">Обувь</div>
                <div class="category-tab" data-category="Одежда">Одежда</div>
                <div class="category-tab" data-category="Сумки">Сумки</div>
                <div class="category-tab" data-category="Часы">Часы</div>
                <div class="category-tab" data-category="Украшения">Украшения</div>
                <div class="category-tab" data-category="Аксессуары">Аксессуары</div>
            </div>

        <!-- Поиск в каталоге -->
            <div class="search-section" style="margin: 8px 0; padding: 16px; background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.05);">
                <h3 style="margin: 0 0 12px 0; color: #1e293b; font-size: 16px; font-weight: 600;">🔍 Поиск товаров</h3>
                <div class="search" style="display: flex; align-items: center; gap: 8px; width: 100%;">
                    <input 
                        type="text" 
                        id="catalogSearchInput" 
                        placeholder="Введите название товара, бренд или категорию..." 
                        autocomplete="off"
                        style="flex: 1; height: 40px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 14px; background: #fff; transition: all 0.2s ease; box-shadow: 0 1px 2px rgba(0,0,0,0.05);"
                    />
                    <button class="search-btn" onclick="performCatalogSearch()" style="height: 40px; padding: 0 16px; border-radius: 8px; border: 1px solid #cbd5e1; background: #527ea6; color: #fff; font-weight: 500; cursor: pointer; transition: all 0.2s ease; display: flex; align-items: center; gap: 6px; font-size: 14px; white-space: nowrap;">
                        🔍 Найти
                    </button>
                </div>
                
                <!-- Фильтры поиска -->
                <div class="search-filters" id="catalogSearchFilters" style="display: none; gap: 6px; margin-top: 12px; flex-wrap: wrap;">
                    <div class="search-filter active" data-filter="all" style="padding: 6px 12px; border-radius: 20px; border: 1px solid #e2e8f0; background: #fff; font-size: 12px; cursor: pointer; transition: all 0.2s ease; color: #64748b; font-weight: 500;">Все товары</div>
                    <div class="search-filter" data-filter="Одежда" style="padding: 6px 12px; border-radius: 20px; border: 1px solid #e2e8f0; background: #fff; font-size: 12px; cursor: pointer; transition: all 0.2s ease; color: #64748b; font-weight: 500;">👕 Одежда</div>
                    <div class="search-filter" data-filter="Обувь" style="padding: 6px 12px; border-radius: 20px; border: 1px solid #e2e8f0; background: #fff; font-size: 12px; cursor: pointer; transition: all 0.2s ease; color: #64748b; font-weight: 500;">👟 Обувь</div>
                    <div class="search-filter" data-filter="Сумки" style="padding: 6px 12px; border-radius: 20px; border: 1px solid #e2e8f0; background: #fff; font-size: 12px; cursor: pointer; transition: all 0.2s ease; color: #64748b; font-weight: 500;">👜 Сумки</div>
                    <div class="search-filter" data-filter="Часы" style="padding: 6px 12px; border-radius: 20px; border: 1px solid #e2e8f0; background: #fff; font-size: 12px; cursor: pointer; transition: all 0.2s ease; color: #64748b; font-weight: 500;">⌚ Часы</div>
                    <div class="search-filter" data-filter="Украшения" style="padding: 6px 12px; border-radius: 20px; border: 1px solid #e2e8f0; background: #fff; font-size: 12px; cursor: pointer; transition: all 0.2s ease; color: #64748b; font-weight: 500;">💍 Украшения</div>
                    <div class="search-filter" data-filter="Аксессуары" style="padding: 6px 12px; border-radius: 20px; border: 1px solid #e2e8f0; background: #fff; font-size: 12px; cursor: pointer; transition: all 0.2s ease; color: #64748b; font-weight: 500;">🕶️ Аксессуары</div>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters-section">
                <div class="filters-header">
                    <h3 class="filters-title">Фильтры</h3>
                    <span class="reset-filters" onclick="resetFilters()">Сбросить</span>
                </div>
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">Бренд</label>
                        <select class="filter-select" id="brandFilter">
                            <option value="">Все бренды</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Подкатегория</label>
                        <select class="filter-select" id="subcategoryFilter">
                            <option value="">Все подкатегории</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Цена</label>
                        <div class="price-inputs">
                            <input type="number" class="price-input" id="minPrice" placeholder="От">
                            <input type="number" class="price-input" id="maxPrice" placeholder="До">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="products-section">
                <div class="section-title">
                    Все товары
                    <span class="section-count" id="productCount">0</span>
                </div>
                <div class="products-grid" id="productsGrid">
                    @foreach($products as $product)
                    <div class="product-card" 
                         data-category="{{ $product['category'] }}" 
                         data-subcategory="{{ $product['subcategory'] }}" 
                         data-brand="{{ $product['brand'] }}" 
                         data-price="{{ $product['price'] }}">
                        <form method="post" action="/favorites/add" style="position:absolute;top:8px;right:8px;z-index:10">
                            @csrf
                            <input type="hidden" name="title" value="{{ $product['title'] }}">
                            <input type="hidden" name="price" value="{{ $product['price'] }}">
                            <input type="hidden" name="image" value="{{ $product['image'] }}">
                            <button type="submit" class="favorite-btn" title="Добавить в избранное">♡</button>
                        </form>
                        
                        <a href="/product/{{ $product['id'] }}" class="product-link">
                            <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" class="product-image">
                            <div class="product-info">
                                <div class="product-title">{{ $product['title'] }}</div>
                                <div class="product-meta">
                                    <span class="product-brand">{{ $product['brand'] }}</span>
                                    <span class="product-price">{{ $product['price'] }}€</span>
                                </div>
                            </div>
                        </a>
                        
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    
    <!-- Модальные окна -->
    <div id="modal-faq" class="modal hidden">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Часто задаваемые вопросы</h3>
                <button onclick="closeModal('faq')" class="close-btn">×</button>
            </div>
            <div class="modal-body">
                <div class="faq-item">
                    <h4>Как сделать заказ?</h4>
                    <p>Выберите товар, добавьте его в корзину и перейдите к оформлению заказа. Заполните форму с вашими данными и выберите способ оплаты.</p>
                </div>
                <div class="faq-item">
                    <h4>Какие способы доставки доступны?</h4>
                    <p>Мы предлагаем стандартную доставку (3-5 дней), экспресс-доставку (1-2 дня) и самовывоз из пунктов выдачи.</p>
                </div>
                <div class="faq-item">
                    <h4>Можно ли вернуть товар?</h4>
                    <p>Да, вы можете вернуть товар в течение 14 дней с момента получения, если он не был в использовании.</p>
                </div>
                <div class="faq-item">
                    <h4>Есть ли гарантия на товары?</h4>
                    <p>Все товары имеют гарантию производителя. Срок гарантии зависит от категории товара.</p>
                </div>
            </div>
        </div>
    </div>
    
    <div id="modal-contact" class="modal hidden">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Контакты</h3>
                <button onclick="closeModal('contact')" class="close-btn">×</button>
            </div>
            <div class="modal-body">
                <div class="contact-info">
                    <h4>Служба поддержки</h4>
                    <p><strong>Телефон:</strong> +7 (495) 123-45-67</p>
                    <p><strong>Email:</strong> support@original-lux-shop.com</p>
                    <p><strong>Время работы:</strong> Пн-Пт 9:00-18:00</p>
                </div>
                <div class="contact-info">
                    <h4>Адрес магазина</h4>
                    <p>г. Москва, ул. Тверская, д. 1</p>
                    <p>Метро: Тверская</p>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        
        .modal.hidden {
            display: none;
        }
        
        .modal-content {
            background: #fff;
            border-radius: 12px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .modal-header h3 {
            margin: 0;
            color: #0f172a;
        }
        
        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #64748b;
        }
        
        .close-btn:hover {
            color: #0f172a;
        }
        
        .close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            color: #aaa;
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .close:hover {
            color: #000;
        }
        
        .modal-body {
            padding: 20px;
        }
        
        .faq-item, .contact-info {
            margin-bottom: 20px;
        }
        
        .faq-item h4, .contact-info h4 {
            color: #0f172a;
            margin-bottom: 8px;
        }
        
        .faq-item p, .contact-info p {
            color: #64748b;
            line-height: 1.6;
        }
        
    </style>
@endsection

@section('scripts')
<script>
    // Данные для фильтров по категориям (бренды взяты из формы добавления товаров)
        const filterData = {
            'Обувь': {
                brands: ['Nike', 'Adidas', 'Asics', 'New Balance', 'Puma', 'Balenciaga', 'Louis Vuitton', 'Dior', 'Prada', 'MM6', 'Alex McQueen', 'Valentino', 'Loro Piana', 'Brunello', 'Hermes', 'Miu Miu', 'Rick Owens', 'Off White', 'Golden Goose', 'Gucci', 'Yeezy'],
                subcategories: ['Кроссовки', 'Кеды', 'Лоферы', 'Ботинки', 'Сандалии', 'Туфли'],
                priceRange: { min: 90, max: 320 }
            },
            'Одежда': {
                brands: ['Louis Vuitton', 'Balenciaga', 'Prada', 'Dior', 'Givenchy', 'Miu Miu', 'Loro Piana', 'Brunello Cucinelli', 'Zegna', 'Burberry', 'Moncler', 'Canada Goose', 'Gucci', 'Hermes', 'Chrome Hearts', 'Ralph Lauren', 'Maison Margiela', 'Essential (Fear of God)', 'Supreme', 'Stone Island', 'CP Company', 'The North Face', 'Arc\'teryx', 'Vetements', 'Nike', 'AMI', 'Loewe', 'YSL', 'Fendi', 'Amiri', 'Represent', 'Off White', 'Kiton', 'Palace', 'Mertra', 'Dolce & Gabbana', 'Celine', 'Chanel'],
                subcategories: ['Зип-худи', 'Шорты', 'Футболки', 'Джинсы', 'Пальто', 'Куртки', 'Рубашки', 'Свитера'],
                priceRange: { min: 45, max: 450 }
            },
            'Сумки': {
                brands: ['Balenciaga', 'Bottega Veneta', 'Celine', 'Chanel', 'Dior', 'Prada', 'Hermes', 'Loewe', 'Louis Vuitton', 'Burberry', 'Miu Miu', 'YSL', 'Goyard', 'Coach', 'Gucci', 'Loro Piana'],
                subcategories: ['Кошелек', 'Рюкзак', 'Клатч', 'Торба', 'Дорожная сумка', 'Мессенджеры'],
                priceRange: { min: 60, max: 350 }
            },
            'Часы': {
                brands: ['Cartier', 'Omega', 'Rolex', 'Tissot', 'Patek Philippe', 'Audemars Piguet'],
                subcategories: ['Механические', 'Кварцевые', 'Автоматические', 'Хронограф', 'Смарт-часы'],
                priceRange: { min: 450, max: 12500 }
            },
            'Украшения': {
                brands: ['Cartier', 'Van Cleef', 'Chrome Hearts', 'Louis Vuitton', 'Bulgari', 'Tiffany'],
                subcategories: ['Кольца', 'Браслеты', 'Цепочки', 'Серьги', 'Подвески', 'Броши'],
                priceRange: { min: 950, max: 3200 }
            },
            'Аксессуары': {
                brands: ['Louis Vuitton', 'Burberry', 'Hermes', 'Dior', 'Prada', 'Gucci', 'Coach', 'Maison Margiela', 'Bottega Veneta', 'Supreme', 'Givenchy', 'Miu Miu', 'Balenciaga', 'Valentino', 'YSL', 'Loro Piana', 'Brunello Cucinelli', 'Chrome Hearts', 'Dolce & Gabbana', 'Fendi'],
                subcategories: ['Очки', 'Ремни', 'Галстуки', 'Шарфы', 'Перчатки', 'Зонты'],
                priceRange: { min: 180, max: 420 }
            }
        };

        // Category tabs
        document.querySelectorAll('.category-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                const category = tab.dataset.category;
                
                if (category === 'all') {
                    document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    updateFilters(category);
                    filterProducts();
                    updateSectionTitle(category);
                } else {
                    // Открываем модальное окно с подкатегориями для выбранной категории
                    showSubcategoriesModal(category);
                }
            });
        });

        // Filters
        document.getElementById('brandFilter').addEventListener('change', filterProducts);
        document.getElementById('subcategoryFilter').addEventListener('change', filterProducts);
        document.getElementById('minPrice').addEventListener('input', filterProducts);
        document.getElementById('maxPrice').addEventListener('input', filterProducts);

        function updateFilters(category) {
            const brandSelect = document.getElementById('brandFilter');
            const subcategorySelect = document.getElementById('subcategoryFilter');
            const minPriceInput = document.getElementById('minPrice');
            const maxPriceInput = document.getElementById('maxPrice');

            // Очищаем текущие опции
            brandSelect.innerHTML = '<option value="">Все бренды</option>';
            subcategorySelect.innerHTML = '<option value="">Все подкатегории</option>';

            if (category !== 'all' && filterData[category]) {
                const data = filterData[category];
                
                // Добавляем бренды
                data.brands.forEach(brand => {
                    const option = document.createElement('option');
                    option.value = brand;
                    option.textContent = brand;
                    brandSelect.appendChild(option);
                });

                // Добавляем подкатегории
                data.subcategories.forEach(subcat => {
                    const option = document.createElement('option');
                    option.value = subcat;
                    option.textContent = subcat;
                    subcategorySelect.appendChild(option);
                });

                // Устанавливаем диапазон цен
                minPriceInput.placeholder = `От ${data.priceRange.min}€`;
                maxPriceInput.placeholder = `До ${data.priceRange.max}€`;
            } else {
                // Для "Все товары" показываем все опции
                const allBrands = [...new Set(Object.values(filterData).flatMap(cat => cat.brands))];
                const allSubcategories = [...new Set(Object.values(filterData).flatMap(cat => cat.subcategories))];
                
                allBrands.forEach(brand => {
                    const option = document.createElement('option');
                    option.value = brand;
                    option.textContent = brand;
                    brandSelect.appendChild(option);
                });

                allSubcategories.forEach(subcat => {
                    const option = document.createElement('option');
                    option.value = subcat;
                    option.textContent = subcat;
                    subcategorySelect.appendChild(option);
                });

                minPriceInput.placeholder = 'От';
                maxPriceInput.placeholder = 'До';
            }
        }

        function filterProducts() {
            const activeCategory = document.querySelector('.category-tab.active').dataset.category;
            const brandFilter = document.getElementById('brandFilter').value;
            const subcategoryFilter = document.getElementById('subcategoryFilter').value;
            const minPrice = document.getElementById('minPrice').value;
            const maxPrice = document.getElementById('maxPrice').value;

            console.log('=== FILTER DEBUG ===');
            console.log('Active Category:', activeCategory);
            console.log('Subcategory Filter:', subcategoryFilter);

            const products = document.querySelectorAll('.product-card');
            let visibleCount = 0;

            products.forEach(product => {
                const category = product.dataset.category;
                const brand = product.dataset.brand;
                const subcategory = product.dataset.subcategory;
                const price = parseInt(product.dataset.price);
                const title = product.querySelector('.product-title')?.textContent || 'Unknown';

                let show = true;

                // Category filter
                if (activeCategory !== 'all' && category !== activeCategory) {
                    show = false;
                }

                // Brand filter
                if (brandFilter && brand !== brandFilter) {
                    show = false;
                }

                // Subcategory filter
                if (subcategoryFilter && subcategory !== subcategoryFilter) {
                    console.log(`❌ ${title}: subcategory="${subcategory}" !== filter="${subcategoryFilter}"`);
                    show = false;
                } else if (subcategoryFilter) {
                    console.log(`✅ ${title}: subcategory="${subcategory}" === filter="${subcategoryFilter}"`);
                }

                // Price filter
                if (minPrice && price < parseInt(minPrice)) {
                    show = false;
                }
                if (maxPrice && price > parseInt(maxPrice)) {
                    show = false;
                }

                product.style.display = show ? 'block' : 'none';
                if (show) visibleCount++;
            });

            console.log('Visible products:', visibleCount);
            document.getElementById('productCount').textContent = visibleCount;
        }

        function updateSectionTitle(category) {
            const title = document.querySelector('.section-title');
            if (category === 'all') {
                title.innerHTML = 'Все товары <span class="section-count" id="productCount">0</span>';
            } else {
                title.innerHTML = `${category} <span class="section-count" id="productCount">0</span>`;
            }
            filterProducts();
        }

        function resetFilters() {
            document.getElementById('brandFilter').value = '';
            document.getElementById('subcategoryFilter').value = '';
            document.getElementById('minPrice').value = '';
            document.getElementById('maxPrice').value = '';
            document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
            document.querySelector('[data-category="all"]').classList.add('active');
            updateFilters('all');
            updateSectionTitle('all');
        }

        // Initialize
        updateFilters('all');
        filterProducts();

        // Функциональный поиск в каталоге
        let catalogSearchTimeout;
        let currentCatalogFilter = 'all';

        // Инициализация поиска в каталоге
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('catalogSearchInput');
            const searchFilters = document.getElementById('catalogSearchFilters');

            // Инициализируем счетчик товаров
            const products = document.querySelectorAll('.product-card');
            const countElement = document.querySelector('.section-count');
            if (countElement) {
                countElement.textContent = products.length;
            }

            // Обработчик ввода в поиск
            searchInput.addEventListener('input', function() {
                clearTimeout(catalogSearchTimeout);
                catalogSearchTimeout = setTimeout(() => {
                    const query = this.value.trim().toLowerCase();
                    if (query.length >= 2) {
                        performCatalogSearch(query);
                        // Убрано: searchFilters.style.display = 'flex';
                    } else if (query.length === 0) {
                        // Показываем все товары только если поле пустое
                        showAllProducts();
                        // НЕ скрываем фильтры, если они уже были показаны
                    }
                }, 300);
            });

            // Обработчики фильтров поиска
            document.querySelectorAll('#catalogSearchFilters .search-filter').forEach(filter => {
                filter.addEventListener('click', function() {
                    document.querySelectorAll('#catalogSearchFilters .search-filter').forEach(f => f.classList.remove('active'));
                    this.classList.add('active');
                    currentCatalogFilter = this.dataset.filter;
                    performCatalogSearch(searchInput.value.trim());
                });
            });

            // Обработчик клика вне поиска (не скрываем фильтры)
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchFilters.contains(e.target)) {
                    // Не скрываем фильтры при клике вне поиска
                }
            });
        });

        // Функция поиска в каталоге
        function performCatalogSearch(query = '') {
            const searchInput = document.getElementById('catalogSearchInput');
            const searchFilters = document.getElementById('catalogSearchFilters');
            
            if (!query) {
                query = searchInput.value.trim().toLowerCase();
            }

            // Убрано: searchFilters.style.display = 'flex';

            const products = document.querySelectorAll('.product-card');
            let visibleCount = 0;

            products.forEach(product => {
                // Получаем данные из data-атрибутов
                const title = product.querySelector('.product-title')?.textContent.toLowerCase() || '';
                const brand = product.querySelector('.product-brand')?.textContent.toLowerCase() || '';
                const category = product.dataset.category || '';
                const subcategory = product.dataset.subcategory || '';
                const price = product.dataset.price || '';

                let show = true;

                // Фильтрация по категории
                if (currentCatalogFilter !== 'all' && category !== currentCatalogFilter) {
                    show = false;
                }

                // Поиск по тексту
                if (query) {
                    const matchesSearch = title.includes(query) ||
                                        brand.includes(query) ||
                                        category.toLowerCase().includes(query) ||
                                        subcategory.toLowerCase().includes(query) ||
                                        price.includes(query);
                    if (!matchesSearch) {
                        show = false;
                    }
                }

                product.style.display = show ? 'block' : 'none';
                if (show) visibleCount++;
            });

            // Обновляем счетчик
            const countElement = document.querySelector('.section-count');
            if (countElement) {
                countElement.textContent = visibleCount;
            }

            // Показываем сообщение если ничего не найдено
            if (visibleCount === 0) {
                showNoResultsMessage();
            } else {
                hideNoResultsMessage();
            }
        }

        // Показать все товары
        function showAllProducts() {
            const products = document.querySelectorAll('.product-card');
            products.forEach(product => {
                product.style.display = 'block';
            });
            
            // Обновляем счетчик
            const countElement = document.querySelector('.section-count');
            if (countElement) {
                countElement.textContent = products.length;
            }
            
            hideNoResultsMessage();
        }

        // Показать сообщение "не найдено"
        function showNoResultsMessage() {
            let noResults = document.getElementById('noResultsMessage');
            if (!noResults) {
                noResults = document.createElement('div');
                noResults.id = 'noResultsMessage';
                noResults.style.cssText = 'text-align: center; padding: 40px; color: #64748b; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 16px; margin: 24px 0; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.05);';
                noResults.innerHTML = `
                    <div style="font-size: 48px; margin-bottom: 16px;">🔍</div>
                    <h3 style="margin: 0 0 8px 0; color: #1e293b; font-size: 18px; font-weight: 600;">Товары не найдены</h3>
                    <p style="margin: 0 0 16px 0; font-size: 14px;">Попробуйте изменить запрос или выбрать другую категорию</p>
                    <div style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
                        <button onclick="resetSearch()" style="padding: 8px 16px; background: #527ea6; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-size: 13px; transition: all 0.2s ease;">Очистить поиск</button>
                        <button onclick="showAllCategories()" style="padding: 8px 16px; background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer; font-size: 13px; transition: all 0.2s ease;">Все категории</button>
                    </div>
                `;
                document.querySelector('.products-grid').appendChild(noResults);
            }
            noResults.style.display = 'block';
        }

        // Скрыть сообщение "не найдено"
        function hideNoResultsMessage() {
            const noResults = document.getElementById('noResultsMessage');
            if (noResults) {
                noResults.style.display = 'none';
            }
        }

        // Очистить поиск
        function resetSearch() {
            const searchInput = document.getElementById('catalogSearchInput');
            searchInput.value = '';
            showAllProducts();
            hideNoResultsMessage();
        }

        // Показать все категории
        function showAllCategories() {
            document.querySelectorAll('#catalogSearchFilters .search-filter').forEach(f => f.classList.remove('active'));
            document.querySelector('[data-filter="all"]').classList.add('active');
            currentCatalogFilter = 'all';
            showAllProducts();
            hideNoResultsMessage();
        }

        // Функции для управления корзиной и избранным
        function toggleCart(title, price, image) {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const existingIndex = cart.findIndex(item => item.title === title);
            
            if (existingIndex === -1) {
                // Добавляем в корзину
                cart.push({ title, price, image });
                localStorage.setItem('cart', JSON.stringify(cart));
                showNotification('Товар добавлен в корзину!', 'success');
            } else {
                // Удаляем из корзины
                cart.splice(existingIndex, 1);
                localStorage.setItem('cart', JSON.stringify(cart));
                showNotification('Товар удален из корзины', 'info');
            }
            
            updateProductStatuses(); // Обновляем статусы
            updateHeaderCounters(); // Обновляем счетчики в хедере
        }

        function toggleFavorite(title, price, image) {
            let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const existingIndex = favorites.findIndex(item => item.title === title);
            
            if (existingIndex === -1) {
                // Добавляем в избранное
                favorites.push({ title, price, image });
                localStorage.setItem('favorites', JSON.stringify(favorites));
                showNotification('Товар добавлен в избранное!', 'success');
            } else {
                // Удаляем из избранного
                favorites.splice(existingIndex, 1);
                localStorage.setItem('favorites', JSON.stringify(favorites));
                showNotification('Товар удален из избранного', 'info');
            }
            
            updateProductStatuses(); // Обновляем статусы
            updateHeaderCounters(); // Обновляем счетчики в хедере
        }

        function updateProductStatuses() {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            
            // Обновляем кнопки избранного
            const favoriteButtons = document.querySelectorAll('.favorite-btn');
            favoriteButtons.forEach(button => {
                const form = button.closest('form');
                const titleInput = form.querySelector('input[name="title"]');
                const title = titleInput ? titleInput.value : '';
                
                const isFavorite = favorites.some(item => item.title === title);
                
                if (isFavorite) {
                    button.classList.add('active');
                    button.innerHTML = '❤';
                    button.title = 'Удалить из избранного';
                } else {
                    button.classList.remove('active');
                    button.innerHTML = '♡';
                    button.title = 'Добавить в избранное';
                }
            });
            
            // Обновляем кнопки корзины
            const cartButtons = document.querySelectorAll('.add-to-cart-btn');
            cartButtons.forEach(button => {
                const form = button.closest('form');
                const titleInput = form.querySelector('input[name="title"]');
                const title = titleInput ? titleInput.value : '';
                
                const isInCart = cart.some(item => item.title === title);
                
                if (isInCart) {
                    button.innerHTML = 'В корзине';
                    button.style.background = '#48bb78';
                    button.style.color = '#ffffff';
                    button.style.fontWeight = '600';
                    button.style.cursor = 'pointer';
                    button.disabled = false;
                    button.title = 'Нажмите, чтобы удалить из корзины';
                } else {
                    button.innerHTML = 'В корзину';
                    button.style.background = '';
                    button.style.color = '';
                    button.style.fontWeight = '';
                    button.style.cursor = '';
                    button.disabled = false;
                    button.title = 'Добавить в корзину';
                }
            });
        }

        function showNotification(message, type = 'info') {
            // Создаем уведомление
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 12px 20px;
                border-radius: 8px;
                color: white;
                font-weight: 500;
                z-index: 10000;
                animation: slideIn 0.3s ease;
                max-width: 300px;
            `;
            
            // Устанавливаем цвет в зависимости от типа
            if (type === 'success') {
                notification.style.background = '#48bb78';
            } else if (type === 'error') {
                notification.style.background = '#f56565';
            } else {
                notification.style.background = '#527ea6';
            }
            
            notification.textContent = message;
            document.body.appendChild(notification);
            
            // Удаляем уведомление через 3 секунды
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        // Локальная функция для обновления счетчиков хедера
        function updateHeaderCounters() {
            console.log('updateHeaderCounters called on catalog page');
            
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            
            // Обновляем счетчик избранного - ДЕСКТОП
            const favoritesBadge = document.getElementById('favorites-badge');
            if (favoritesBadge) {
                favoritesBadge.textContent = favorites.length;
                favoritesBadge.style.display = favorites.length > 0 ? 'block' : 'none';
            }
            
            // Обновляем счетчик избранного - МОБИЛЬНЫЙ
            const mobileFavoritesBadge = document.querySelector('.mobile-favorites-badge');
            if (mobileFavoritesBadge) {
                mobileFavoritesBadge.textContent = favorites.length;
                mobileFavoritesBadge.style.display = favorites.length > 0 ? 'block' : 'none';
            }
            
            // Обновляем счетчик корзины - ДЕСКТОП
            const cartBadge = document.getElementById('cart-badge');
            let totalItems = 0;
            if (cartBadge) {
                totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
                cartBadge.textContent = totalItems;
                cartBadge.style.display = totalItems > 0 ? 'block' : 'none';
            }
            
            // Обновляем счетчик корзины - МОБИЛЬНЫЙ
            const mobileCartBadge = document.querySelector('.mobile-cart-badge');
            if (mobileCartBadge) {
                totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
                mobileCartBadge.textContent = totalItems;
                mobileCartBadge.style.display = totalItems > 0 ? 'block' : 'none';
            }
            
            console.log('Counters updated:', {favorites: favorites.length, cart: totalItems});
        }

        // Добавляем CSS для анимации уведомлений
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);

        // Инициализация при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            updateProductStatuses();
            updateHeaderCounters(); // Обновляем счетчики в хедере
            
            // Обработчики для форм добавления в корзину
            const cartForms = document.querySelectorAll('form[action="/cart/add"]');
            cartForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(form);
                    const title = formData.get('title');
                    const price = formData.get('price');
                    const image = formData.get('image');
                    
                    // Используем функцию переключения
                    toggleCart(title, price, image);
                });
            });
            
            // Обработчики для форм избранного
            const favoriteForms = document.querySelectorAll('form[action="/favorites/add"]');
            favoriteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(form);
                    const title = formData.get('title');
                    const price = formData.get('price');
                    const image = formData.get('image');
                    
                    // Используем функцию переключения
                    toggleFavorite(title, price, image);
                });
            });
        });
        
        // ===== МОДАЛЬНОЕ ОКНО ПОДКАТЕГОРИЙ =====
        const subcategoryData = {
            'Обувь': {
                emoji: '👟',
                title: 'Обувь',
                subtitle: 'Выберите подкатегорию',
                subcategories: [
                    {name: 'Кроссовки'},
                    {name: 'Лоферы'},
                    {name: 'Сандалии'},
                    {name: 'Ботинки'},
                    {name: 'Босоножки'},
                    {name: 'Кеды'}
                ]
            },
            'Одежда': {
                emoji: '👕',
                title: 'Одежда',
                subtitle: 'Выберите тип одежды',
                subcategories: [
                    {name: 'Шорты'},
                    {name: 'Штаны'},
                    {name: 'Джинсы'},
                    {name: 'Брюки'},
                    {name: 'Футболки'},
                    {name: 'Майки'},
                    {name: 'Поло'},
                    {name: 'Лонгсливы'},
                    {name: 'Джемпер'},
                    {name: 'Свитер'},
                    {name: 'Свитшот'},
                    {name: 'Кардиган'},
                    {name: 'Худи'},
                    {name: 'Зип-худи'},
                    {name: 'Рубашки'},
                    {name: 'Кофты'},
                    {name: 'Платья'},
                    {name: 'Блузки'},
                    {name: 'Костюмы'},
                    {name: 'Бомберы'},
                    {name: 'Куртки'},
                    {name: 'Ветровки'},
                    {name: 'Пиджаки'},
                    {name: 'Пуховики'},
                    {name: 'Жилетки'},
                    {name: 'Пальто'},
                    {name: 'Водолазки'}
                ]
            },
            'Сумки': {
                emoji: '👜',
                title: 'Сумки',
                subtitle: 'Выберите тип сумки',
                subcategories: [
                    {name: 'Картхолдеры'},
                    {name: 'Кошельки'},
                    {name: 'Тоут'},
                    {name: 'Через плечо'},
                    {name: 'Рюкзаки'},
                    {name: 'Косметички'},
                    {name: 'Клатчи'},
                    {name: 'Сумки'},
                    {name: 'Дорожные сумки'},
                    {name: 'Мессенджеры'}
                ]
            },
            'Часы': {
                emoji: '⌚',
                title: 'Часы',
                subtitle: 'Выберите тип часов',
                subcategories: [
                    {name: 'Наручные часы'},
                    {name: 'Карманные часы'},
                    {name: 'Настенные часы'},
                    {name: 'Спортивные часы'}
                ]
            },
            'Украшения': {
                emoji: '💍',
                title: 'Украшения',
                subtitle: 'Выберите тип украшений',
                subcategories: [
                    {name: 'Серьги'},
                    {name: 'Браслеты'},
                    {name: 'Кулоны'},
                    {name: 'Колье'},
                    {name: 'Подвески'}
                ]
            },
            'Аксессуары': {
                emoji: '🎒',
                title: 'Аксессуары',
                subtitle: 'Выберите тип аксессуаров',
                subcategories: [
                    {name: 'Ремни'},
                    {name: 'Шарфы'},
                    {name: 'Шапки'},
                    {name: 'Панамы'},
                    {name: 'Очки'},
                    {name: 'Перчатки'}
                ]
            }
        };
        
        function openSubcategoryModal(category) {
            const data = subcategoryData[category];
            if (!data) return;
            
            // Создаем модальное окно
            const modal = document.createElement('div');
            modal.className = 'subcategory-modal-overlay';
            modal.innerHTML = `
                <div class="subcategory-modal">
                    <div class="subcategory-modal-header">
                        <h2 class="subcategory-modal-title">${data.emoji} ${data.title}</h2>
                        <p class="subcategory-modal-subtitle">${data.subtitle}</p>
                        <button class="subcategory-modal-close">&times;</button>
                    </div>
                    <div class="subcategory-modal-body">
                        <div class="subcategory-grid">
                            ${data.subcategories.map(sub => `
                                <div class="subcategory-item" data-subcategory="${sub.name}">
                                    <div class="subcategory-name">${sub.name}</div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            
            // Показываем модальное окно с анимацией
            setTimeout(() => modal.classList.add('active'), 10);
            document.body.style.overflow = 'hidden';
            
            // Закрытие по крестику
            modal.querySelector('.subcategory-modal-close').addEventListener('click', (e) => {
                e.stopPropagation();
                closeSubcategoryModal(modal);
            });
            
            // Закрытие по клику на фон
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeSubcategoryModal(modal);
                }
            });
            
            // Закрытие по Escape
            const escapeHandler = (e) => {
                if (e.key === 'Escape') {
                    closeSubcategoryModal(modal);
                    document.removeEventListener('keydown', escapeHandler);
                }
            };
            document.addEventListener('keydown', escapeHandler);
            
            // Обработка клика по подкатегории
            modal.querySelectorAll('.subcategory-item').forEach(item => {
                item.addEventListener('click', () => {
                    const subcategory = item.dataset.subcategory;
                    applySubcategoryFilter(category, subcategory);
                    closeSubcategoryModal(modal);
                });
            });
        }
        
        function closeSubcategoryModal(modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
            setTimeout(() => {
                if (modal.parentNode) {
                    modal.parentNode.removeChild(modal);
                }
            }, 300);
        }
        
        function applySubcategoryFilter(category, subcategory) {
            console.log('Применен фильтр:', category, subcategory);
            
            // Устанавливаем активную категорию
            document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
            const categoryTab = document.querySelector(`[data-category="${category}"]`);
            if (categoryTab) {
                categoryTab.classList.add('active');
            }
            
            // Сначала обновляем фильтры для категории
            updateFilters(category);
            
            // Затем устанавливаем подкатегорию в фильтр
            const subcategoryFilter = document.getElementById('subcategoryFilter');
            if (subcategoryFilter) {
                // Ищем опцию с таким значением
                let option = Array.from(subcategoryFilter.options).find(opt => opt.value === subcategory);
                if (!option) {
                    // Если нет, добавляем её
                    option = new Option(subcategory, subcategory);
                    subcategoryFilter.add(option);
                }
                subcategoryFilter.value = subcategory;
            }
            
            // Применяем фильтры - фильтруем товары
            filterProducts();
            
            // Обновляем заголовок секции
            updateSectionTitle(category);
            
            // Показываем уведомление
            showNotification(`Фильтр применён: ${category} → ${subcategory}`, 'success');
        }
        
        // Добавляем обработчики на категории
        document.querySelectorAll('.category-tab').forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                const category = tab.dataset.category;
                
                if (category === 'all') {
                    document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    updateFilters(category);
                } else {
                    // Открываем модальное окно подкатегорий
                    openSubcategoryModal(category);
                }
            });
        });
    </script>
@endsection
