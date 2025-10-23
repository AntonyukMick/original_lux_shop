@extends('layouts.app')

@section('title', 'ORIGINAL | LUX SHOP')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    :root { --bg:#f1f5f9; --card:#ffffff; --muted:#e2e8f0; --text:#0f172a; --accent:#527ea6; }
    *{box-sizing:border-box}
    body{margin:0;background:var(--bg);font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,'Helvetica Neue',Arial,"Noto Sans",sans-serif;color:var(--text)}
    .container{max-width:1140px;margin:0 auto;padding:12px}
    
    /* Мягкие стили для кнопок товаров */
    .good .btn {
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
    }
    
    .good .btn:hover {
        background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
        color: #1e293b;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-color: #cbd5e1;
    }
    
    .good .btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .grid-top{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin:12px 0}
    .tile{background:var(--card);border:1px solid #cbd5e1;border-radius:10px;padding:16px;position:relative;min-height:100px;transition:all 0.2s ease}
    .tile h3{margin:0 0 6px 0;font-size:16px;font-weight:700;color:#1e293b}
    .tile p{margin:0;color:#475569;font-weight:500}
    
    /* Стили для верхних кнопок как на эскизе */
    .grid-top .tile h3 {
        font-size: 20px;
        font-weight: 700;
        color: #333;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0 0 8px 0;
    }
    
    .grid-top .tile p {
        font-size: 18px;
        font-weight: 700;
        color: #333;
        margin: 0;
    }
        /* Улучшенные стили для поиска - на всю ширину с лупой */
        .search {
            margin: 16px 0;
            position: relative;
        }
        
        .search-input-wrapper {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
        }
        
        .search input {
            width: 100%;
            height: 44px;
            border-radius: 8px;
            border: 2px solid #cbd5e1;
            padding: 0 50px 0 16px;
            font-size: 15px;
            background: #fff;
            transition: all 0.2s ease;
        }
        
        .search input:focus {
            outline: none;
            border-color: #527ea6;
            box-shadow: 0 0 0 3px rgba(82, 126, 166, 0.1);
        }
        
        .search input::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }
        
        .search-icon-btn {
            position: absolute;
            right: 4px;
            height: 36px;
            width: 40px;
            border-radius: 6px;
            border: none;
            background: transparent;
            color: #64748b;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .search-icon-btn:hover {
            background: #f1f5f9;
            color: #527ea6;
        }
        
        .search-icon-btn:active {
            transform: scale(0.95);
        }
        
        /* Стили для блока "Хотите увидеть больше товаров?" */
        .more-products-block {
            text-align: center;
            margin-top: 32px;
            padding: 24px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
        }
        
        .more-products-title {
            margin: 0 0 16px 0;
            color: #0f172a;
            font-size: 20px;
            font-weight: 700;
        }
        
        .more-products-text {
            margin: 0 0 20px 0;
            color: #64748b;
            font-size: 15px;
            line-height: 1.5;
        }
        
        .more-products-btn {
            display: inline-block;
            padding: 12px 24px;
            background: #527ea6;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
        }
        
        .more-products-btn:hover {
            background: #3b5a7a;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        /* Стили для результатов поиска - более сдержанные */
        .search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            z-index: 1000;
            max-height: 300px;
            overflow-y: auto;
            display: none;
            margin-top: 4px;
        }
        
        .search-result-item {
            padding: 10px 12px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: background 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .search-result-item:hover {
            background: #f8fafc;
        }
        
        .search-result-item:last-child {
            border-bottom: none;
        }
        
        .search-result-img {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            object-fit: cover;
            border: 1px solid #e2e8f0;
        }
        
        .search-result-info {
            flex: 1;
        }
        
        .search-result-title {
            font-weight: 500;
            color: #1e293b;
            margin-bottom: 2px;
            font-size: 13px;
        }
        
        .search-result-category {
            font-size: 11px;
            color: #64748b;
        }
        
        .search-result-price {
            font-weight: 600;
            color: #059669;
            font-size: 13px;
        }
        
        .no-results {
            padding: 16px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }
        
        .tabs{display:flex;gap:8px}
        .tab{flex:1;text-align:center;background:#c0cfdd;border:1px solid #99aec2;border-radius:8px;padding:8px 10px;font-weight:600;cursor:pointer}
        .tab.active{background:#527ea6;color:#fff}
        .catalog{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:12px}
        .card{background:var(--card);border:1px solid var(--muted);border-radius:10px;padding:12px;display:flex;flex-direction:column;gap:10px}
        .card h4{margin:0;font-size:16px;font-weight:600;color:#333;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif}
        .img img{width:100%;height:100%;object-fit:cover;border-radius:8px}
        
        /* Стили для информационных блоков согласно эскизу */
        .info-blocks {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin: 20px 0;
        }
        
        .intro-block {
            background: #e6e6fa;
            border: 1px solid #d3d3d3;
            border-radius: 12px;
            padding: 20px;
            position: relative;
        }
        
        .intro-block .intro-title {
            font-size: 22px;
            font-weight: 600;
            color: #333;
            margin: 0 0 8px 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        
        .intro-block .intro-subtitle {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        
        .intro-block .play-icon {
            position: absolute;
            bottom: 16px;
            right: 16px;
            width: 40px;
            height: 40px;
            border: 2px solid #333;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
        }
        
        .intro-block .play-icon::before {
            content: '';
            width: 0;
            height: 0;
            border-left: 12px solid #333;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
            margin-left: 4px;
        }
        
        .offer-block {
            background: #e0e7ff;
            border: 1px solid #d3d3d3;
            border-radius: 12px;
            padding: 20px;
            position: relative;
        }
        
        .offer-block .offer-title {
            font-size: 22px;
            font-weight: 700;
            color: #333;
            margin: 0 0 8px 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        
        .offer-block .offer-main {
            font-size: 30px;
            font-weight: 700;
            color: #333;
            margin: 0 0 8px 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        
        .offer-block .offer-subtitle {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        
        .offer-block .chat-icon {
            position: absolute;
            bottom: 16px;
            right: 16px;
            width: 40px;
            height: 40px;
            background: #e0e7ff;
            border: 2px solid #333;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        /* Нижняя часть страницы */
        .banner{margin:16px 0;background:#e6eaf2;border:1px solid #cbd5e1;border-radius:10px;padding:14px;text-align:center;font-weight:700;font-size:28px;letter-spacing:.5px}
        .small-tiles{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin:12px 0}
        .promo{margin:8px 0;background:#eef2ff;border:1px solid #cbd5e1;border-radius:10px;padding:14px;transition:all 0.2s ease}
        .promo:hover{transform:translateY(-2px);box-shadow:0 4px 8px rgba(0,0,0,0.1);border-color:#527ea6}
        .promo h3{margin:0 0 6px 0;font-size:18px}
        .promo p{margin:0;color:#475569;font-size:13px}
        .section-title{margin:18px 0 10px 0;font-weight:700;font-size:18px}
        .goods{display:grid;grid-template-columns:1fr;gap:14px;align-items:stretch}
        .good{background:#fff;border:1px solid #cbd5e1;border-radius:10px;padding:12px;display:flex;flex-direction:column;height:100%;min-height:280px}
        .good img{width:100%;border-radius:8px;aspect-ratio:4/3;object-fit:cover;background:#f1f5f9;flex-shrink:0}
        .good .meta{display:flex;justify-content:space-between;gap:12px;margin:8px 0 10px 0;font-size:12px;color:#475569;flex-grow:1;min-height:40px}
        .good form{margin-top:auto;flex-shrink:0}
        .good .price{font-weight:700;color:#0f172a;flex-shrink:0}
        
        /* Дополнительные стили для выравнивания кнопок */
        .good .meta {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-start;
        }
        
        .good .meta > div {
            width: 100%;
        }
        
        .good .meta > div:first-child {
            margin-bottom: 4px;
        }
        
        .good form {
            width: 100%;
        }
        
        .good .btn {
            width: 100%;
            justify-content: center;
        }
        
        /* Стили для новых элементов товара */
        .product-gender {
            margin: 4px 0;
        }
        
        .gender-badge {
            display: inline-block;
            background: #e2e8f0;
            color: #374151;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 11px;
            margin-right: 4px;
            font-weight: 500;
        }
        
        .product-sizes {
            margin: 4px 0;
            font-size: 12px;
        }
        
        .sizes-label {
            color: #64748b;
            margin-right: 4px;
        }
        
        .size-badge {
            display: inline-block;
            background: #f1f5f9;
            color: #475569;
            padding: 1px 4px;
            border-radius: 3px;
            font-size: 10px;
            margin-right: 2px;
            border: 1px solid #e2e8f0;
        }
        
        .size-more {
            color: #64748b;
            font-size: 10px;
        }
        
        .product-colors {
            margin: 4px 0;
            font-size: 12px;
        }
        
        .colors-label {
            color: #64748b;
            margin-right: 4px;
        }
        
        .color-swatch {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 1px solid #e2e8f0;
            margin-right: 3px;
            vertical-align: middle;
        }
        
        .color-more {
            color: #64748b;
            font-size: 10px;
        }
        
        /* Мобильная адаптация для товаров */
        @media (max-width:768px){
            .goods{grid-template-columns:repeat(2,1fr);gap:8px;align-items:stretch}
            .good{padding:8px;border-radius:8px;display:flex;flex-direction:column;height:100%;min-height:240px}
            .good img{border-radius:6px;aspect-ratio:1/1;flex-shrink:0}
            .good .meta{font-size:11px;margin:6px 0 8px 0;gap:8px;flex-grow:1;min-height:35px}
            .good form{margin-top:auto;flex-shrink:0}
            .good .price{font-size:13px;flex-shrink:0}
            .section-title{font-size:16px;margin:12px 0 8px 0}
            .good .btn{height:28px;padding:0 12px;font-size:11px;border-radius:14px}
            .favorite-btn{width:24px;height:24px;font-size:12px;top:6px;right:6px}
            
            /* Унифицированная высота кнопок для мобильных */
            .good .btn[style*="background:#48bb78"], 
            .good .btn[style*="background: #48bb78"] {
                height: 28px !important;
            }
            
            /* Адаптивные стили для информационных блоков */
            .info-blocks {
                grid-template-columns: 1fr;
                gap: 12px;
                margin: 16px 0;
            }
            
            .intro-block, .offer-block {
                padding: 16px;
            }
            
            .intro-block .intro-title {
                font-size: 20px;
            }
            
            .intro-block .intro-subtitle {
                font-size: 16px;
            }
            
            .offer-block .offer-title {
                font-size: 20px;
            }
            
            .offer-block .offer-main {
                font-size: 26px;
            }
            
            .offer-block .offer-subtitle {
                font-size: 16px;
            }
            
            .intro-block .play-icon, .offer-block .chat-icon {
                width: 32px;
                height: 32px;
                bottom: 12px;
                right: 12px;
            }
            
            .intro-block .play-icon::before {
                border-left: 10px solid #333;
                border-top: 6px solid transparent;
                border-bottom: 6px solid transparent;
            }
            
            .banner{margin:12px 0;padding:10px;font-size:20px;letter-spacing:0.3px}
            .small-tiles{margin:8px 0;gap:8px}
            .small-tiles .tile{padding:10px;min-height:80px}
            .small-tiles .tile h3{font-size:14px;margin:0 0 4px 0}
            .small-tiles .tile p{font-size:11px;line-height:1.3}
            .promo{margin:6px 0;padding:10px}
            .promo h3{font-size:16px;margin:0 0 4px 0}
            .promo p{font-size:11px;line-height:1.3}
            
            /* Сжатые стили для верхних блоков */
            .grid-top{margin:8px 0;gap:8px}
            .grid-top .tile{padding:10px;min-height:80px}
            .grid-top .tile h3{font-size:13px;margin:0 0 4px 0;line-height:1.3;font-weight:600;color:#1e293b}
            .grid-top .tile p{font-size:13px;margin:0 0 4px 0;line-height:1.3;font-weight:600;color:#64748b;opacity:0.8}
            
            /* Сжатые стили для кнопок каталога */
            .tabs{gap:6px;margin:8px 0}
            .tab{padding:6px 8px;font-size:12px;border-radius:6px}
            
            /* Адаптивные стили для поиска */
            .search{margin:12px 0}
            .search input{height:42px;font-size:14px;padding:0 48px 0 14px}
            .search-icon-btn{height:34px;width:38px;font-size:18px}
            
            /* Адаптивные стили для блока "Хотите увидеть больше" */
            .more-products-block{margin-top:20px;padding:16px;border-radius:10px}
            .more-products-title{font-size:17px;margin:0 0 12px 0}
            .more-products-text{font-size:14px;margin:0 0 16px 0;line-height:1.4}
            .more-products-btn{padding:10px 20px;font-size:13px;border-radius:7px}
        }
        
        @media (max-width:480px){
            .goods{grid-template-columns:repeat(2,1fr);gap:6px;align-items:stretch}
            .good{padding:6px;border-radius:6px;display:flex;flex-direction:column;height:100%;min-height:200px}
            .good img{border-radius:4px;aspect-ratio:1/1;flex-shrink:0}
            .good .meta{font-size:10px;margin:4px 0 6px 0;gap:6px;flex-direction:column;align-items:flex-start;flex-grow:1;min-height:30px}
            .good .meta > div:first-child{line-height:1.2;margin-bottom:2px}
            .good form{margin-top:auto;flex-shrink:0}
            .good .price{font-size:12px;font-weight:600;flex-shrink:0}
            .section-title{font-size:14px;margin:10px 0 6px 0}
            .good .btn{height:24px;padding:0 8px;font-size:10px;border-radius:12px}
            .favorite-btn{width:20px;height:20px;font-size:10px;top:4px;right:4px}
            
            /* Унифицированная высота кнопок для маленьких экранов */
            .good .btn[style*="background:#48bb78"], 
            .good .btn[style*="background: #48bb78"] {
                height: 24px !important;
            }
            
            /* Еще более сжатые стили для информационных блоков */
            .intro-block, .offer-block {
                padding: 12px;
            }
            
            .intro-block .intro-title {
                font-size: 18px;
            }
            
            .intro-block .intro-subtitle {
                font-size: 14px;
            }
            
            .offer-block .offer-title {
                font-size: 18px;
            }
            
            .offer-block .offer-main {
                font-size: 22px;
            }
            
            .offer-block .offer-subtitle {
                font-size: 14px;
            }
            
            .intro-block .play-icon, .offer-block .chat-icon {
                width: 28px;
                height: 28px;
                bottom: 8px;
                right: 8px;
                font-size: 16px;
            }
            
            .intro-block .play-icon::before {
                border-left: 8px solid #333;
                border-top: 5px solid transparent;
                border-bottom: 5px solid transparent;
            }
            
            /* Еще более сжатые стили для маленьких экранов */
            .banner{margin:8px 0;padding:8px;font-size:18px;letter-spacing:0.2px}
            .small-tiles{margin:6px 0;gap:6px}
            .small-tiles .tile{padding:8px;min-height:70px}
            .small-tiles .tile h3{font-size:13px;margin:0 0 3px 0}
            .small-tiles .tile p{font-size:10px;line-height:1.2}
            .promo{margin:4px 0;padding:8px}
            .promo h3{font-size:15px;margin:0 0 3px 0}
            .promo p{font-size:10px;line-height:1.2}
            
            /* Еще более сжатые стили для верхних блоков */
            .grid-top{margin:6px 0;gap:6px}
            .grid-top .tile{padding:8px;min-height:70px}
            .grid-top .tile h3{font-size:12px;margin:0 0 3px 0;line-height:1.2;font-weight:600;color:#1e293b}
            .grid-top .tile p{font-size:12px;margin:0 0 3px 0;line-height:1.2;font-weight:600;color:#64748b;opacity:0.8}
            
            /* Еще более сжатые стили для кнопок каталога */
            .tabs{gap:4px;margin:6px 0}
            .tab{padding:4px 6px;font-size:11px;border-radius:4px}
            
            /* Адаптивные стили для поиска на маленьких экранах */
            .search{margin:10px 0}
            .search input{height:40px;font-size:13px;padding:0 46px 0 12px}
            .search-icon-btn{height:32px;width:36px;font-size:16px}
            
            /* Адаптивные стили для блока "Хотите увидеть больше" на маленьких экранах */
            .more-products-block{margin-top:16px;padding:12px;border-radius:8px}
            .more-products-title{font-size:15px;margin:0 0 10px 0;line-height:1.3}
            .more-products-text{font-size:13px;margin:0 0 14px 0;line-height:1.4}
            .more-products-btn{padding:10px 18px;font-size:12px;border-radius:6px;display:block;width:100%}
        }
        
        @media (min-width:900px){
            .goods{grid-template-columns:repeat(2,1fr)}
        }
        /* Фильтры */
        .shop-layout{display:grid;grid-template-columns:1fr;gap:12px;margin-top:12px}
        @media (min-width:900px){.shop-layout{grid-template-columns:280px 1fr}}
        .filters{background:#fff;border:1px solid #cbd5e1;border-radius:10px;padding:8px;position:sticky;top:12px;height:max-content;overflow-y:auto;max-height:calc(100vh - 24px)}
        @media (max-width:768px){
            .filters{display:none}
        }
        .filters-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px}
        .filters-header h3{margin:0;font-size:18px}
        .reset{font-size:12px;color:#2563eb;cursor:pointer;text-decoration:underline}
        .filter-group{border:1px solid #cbd5e1;border-radius:8px;margin:8px 0}
        .filter-head{display:flex;align-items:center;justify-content:space-between;padding:8px 10px;cursor:pointer;background:#f1f5f9;border-radius:8px}
        .filter-body{padding:8px 10px;display:none}
        .filter-group.open .filter-body{display:block}
        .filter-list{display:flex;flex-direction:column;gap:6px;max-height:220px;overflow:auto}
        .filter-item{border:1px solid #cbd5e1;border-radius:6px;padding:6px 8px;background:#fff;cursor:pointer}
        .filter-item.active{background:#527ea6;color:#fff;border-color:#527ea6}
        .price-row{display:flex;gap:8px;flex-wrap:wrap}
        .price-row input{flex:1 1 140px;min-width:0;height:28px;font-size:12px;border-radius:8px;border:1px solid #cbd5e1;padding:0 10px}
        
        /* Мобильные стили для фильтров */
        @media (max-width:768px){
            .filters-header h3{font-size:16px}
            .reset{font-size:11px}
            .filter-group{margin:6px 0;border-radius:6px}
            .filter-head{padding:6px 8px;font-size:14px}
            .filter-body{padding:6px 8px}
            .filter-list{max-height:180px;gap:4px}
            .filter-item{padding:4px 6px;font-size:12px;border-radius:4px}
            .price-row{gap:6px}
            .price-row input{height:24px;font-size:11px;padding:0 8px;border-radius:6px}
        }
        
        @media (max-width:480px){
            .filters-header h3{font-size:14px}
            .reset{font-size:10px}
            .filter-group{margin:4px 0;border-radius:4px}
            .filter-head{padding:4px 6px;font-size:12px}
            .filter-body{padding:4px 6px}
            .filter-list{max-height:150px;gap:3px}
            .filter-item{padding:3px 5px;font-size:11px;border-radius:3px}
            .price-row{gap:4px}
            .price-row input{height:22px;font-size:10px;padding:0 6px;border-radius:4px}
        }
        @media (min-width:900px){
            .catalog{grid-template-columns:repeat(3,1fr)}
        }

        /* Модальные окна */
        /* НОВАЯ СТРУКТУРА МОДАЛЬНЫХ ОКОН */
        .modal-overlay{
            position:fixed;
            inset:0;
            z-index:1000;
            background-color:rgba(0,0,0,0.75);
            display:none;
            align-items:center;
            justify-content:center;
            padding:20px;
            opacity:0;
            transition:opacity 0.3s ease;
        }
        .modal-overlay.active{
            display:flex;
            opacity:1;
        }
        .modal-dialog{
            background:#fff;
            border-radius:12px;
            width:100%;
            max-width:600px;
            max-height:90vh;
            display:flex;
            flex-direction:column;
            box-shadow:0 20px 60px rgba(0,0,0,0.3);
            transform:scale(0.95);
            transition:transform 0.3s ease;
        }
        .modal-overlay.active .modal-dialog{
            transform:scale(1);
        }
        .modal-header{
            padding:20px 60px 20px 20px;
            border-bottom:1px solid #e2e8f0;
            position:relative;
        }
        .modal-header h2{
            margin:0;
            font-size:20px;
            color:#0f172a;
        }
        .modal-close{
            position:absolute;
            top:15px;
            right:15px;
            width:40px;
            height:40px;
            border:none;
            background:none;
            font-size:28px;
            color:#94a3b8;
            cursor:pointer;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius:50%;
            transition:all 0.2s ease;
            line-height:1;
        }
        .modal-close:hover{
            background:#fee;
            color:#ef4444;
            transform:rotate(90deg);
        }
        .modal-body{
            padding:20px;
            overflow-y:auto;
            color:#475569;
            line-height:1.6;
        }
        .modal-body h3{
            margin:20px 0 10px 0;
            color:#0f172a;
            font-size:16px;
        }
        .modal-body ul{
            margin:0;
            padding-left:20px;
        }
        .modal-body li{
            margin:8px 0;
            color:#475569;
        }
        
        /* Старые классы для обратной совместимости */
        .modal{position:fixed;z-index:1000;left:0;top:0;width:100%;height:100%;background-color:rgba(0,0,0,0.5);display:flex;align-items:center;justify-content:center;padding:20px;box-sizing:border-box}
        .modal.hidden{display:none !important}
        .modal-content{background-color:#fff;padding:20px;border-radius:12px;width:90%;max-width:600px;max-height:90vh;overflow-y:auto;position:relative;box-shadow:0 10px 30px rgba(0,0,0,0.3)}
        .close{position:absolute;top:15px;right:20px;color:#94a3b8;font-size:32px;font-weight:bold;cursor:pointer;line-height:1;z-index:1000;transition:all 0.2s ease;background:none;border:none;padding:0;width:40px;height:40px;display:flex;align-items:center;justify-content:center;pointer-events:auto;user-select:none}
        .close:hover{color:#ef4444;transform:scale(1.1);background:rgba(239,68,68,0.1);border-radius:50%}
        .close:active{transform:scale(0.95)}
        
        /* Фильтры в модальных окнах */
        .modal-filters{margin:20px 0;padding:15px;background:#f8fafc;border-radius:8px}
        .filter-row{display:flex;gap:10px;flex-wrap:wrap}
        .filter-row select{flex:1;min-width:120px;height:36px;border:1px solid #cbd5e1;border-radius:6px;padding:0 10px;background:#fff}
        
        /* Карточки товаров в модальных окнах */
        .modal-products{display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:8px;margin-top:20px}
        .product-card{background:#fff;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;transition:transform 0.2s}
        .product-card:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(0,0,0,0.1)}
        .product-card img{width:100%;height:120px;object-fit:cover;max-width:100%;max-height:120px}
        
        /* Уменьшенные размеры для карточек в модальных окнах */
        .modal .product-card {
            min-width: 140px;
            max-width: 180px;
        }
        
        .modal .product-card img {
            width: 100%;
            height: 80px; /* Уменьшено с 120px до 80px */
            object-fit: cover;
        }
        
        .modal .product-info {
            padding: 6px; /* Уменьшено с 8px до 6px */
        }
        
        .modal .product-info h4 {
            margin: 0 0 3px 0; /* Уменьшено с 4px до 3px */
            font-size: 11px; /* Уменьшено с 12px до 11px */
            font-weight: 600;
        }
        
        .modal .product-info .brand {
            margin: 0 0 2px 0; /* Уменьшено с 3px до 2px */
            font-size: 9px; /* Уменьшено с 10px до 9px */
            color: #64748b;
        }
        
        .modal .product-info .price {
            margin: 0 0 4px 0; /* Уменьшено с 6px до 4px */
            font-size: 12px; /* Уменьшено с 14px до 12px */
            font-weight: 700;
            color: #0f172a;
        }
        
        .modal .add-to-cart-btn {
            width: 100%;
            height: 24px; /* Уменьшено с 28px до 24px */
            background: #527ea6;
            color: #ffffff;
            border: none;
            border-radius: 4px; /* Уменьшено с 6px до 4px */
            font-size: 10px; /* Уменьшено с 11px до 10px */
            cursor: pointer;
            transition: background 0.2s;
            font-weight: 600;
        }
        
        .modal .add-to-cart-btn:hover {
            background: #3b5a7a;
        }
        
        /* Стили для кнопки "В корзине" в модальных окнах */
        .modal .add-to-cart-btn[style*="background:#48bb78"], 
        .modal .add-to-cart-btn[style*="background: #48bb78"] {
            background: #48bb78 !important;
            color: #ffffff !important;
            font-weight: 600;
        }
        
        .modal .add-to-cart-btn[style*="background:#48bb78"]:hover, 
        .modal .add-to-cart-btn[style*="background: #48bb78"]:hover {
            background: #38a169 !important;
        }
        
        /* Стили для кнопки Telegram в модальных окнах */
        .telegram-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: #0088cc;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 16px;
        }
        
        .telegram-btn:hover {
            background: #006ba1;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 136, 204, 0.3);
        }
        
        /* Адаптивные стили для кнопки Telegram */
        @media (max-width: 768px) {
            .telegram-btn {
                padding: 10px 18px;
                gap: 6px;
                font-size: 14px;
            }
        }
        
        @media (max-width: 480px) {
            .telegram-btn {
                padding: 8px 14px;
                gap: 4px;
                font-size: 13px;
                border-radius: 6px;
            }
            
            .telegram-btn span:first-child {
                font-size: 16px;
            }
        }
        
        /* Общие стили для карточек товаров */
        .product-info{padding:8px}
        .product-info h4{margin:0 0 4px 0;font-size:12px;font-weight:600}
        .product-info .brand{margin:0 0 3px 0;font-size:10px;color:#64748b}
        .product-info .price{margin:0 0 6px 0;font-size:14px;font-weight:700;color:#0f172a}
        .original-price{font-size:12px;color:#94a3b8;text-decoration:line-through;margin-left:8px}
        .custom-note{font-size:11px;color:#059669;margin:0 0 8px 0}
        .add-to-cart-btn{width:100%;height:28px;background:#527ea6;color:#ffffff;border:none;border-radius:6px;font-size:11px;cursor:pointer;transition:background 0.2s;font-weight:600}
        .add-to-cart-btn:hover{background:#3b5a7a}
        
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
        
        /* Унифицированные стили для кнопок корзины в товарах */
        .good .btn[style*="background:#48bb78"], 
        .good .btn[style*="background: #48bb78"] {
            background: #48bb78 !important;
            color: #ffffff !important;
            font-weight: 600;
        }
        
        .good .btn[style*="background:#48bb78"]:hover, 
        .good .btn[style*="background: #48bb78"]:hover {
            background: #38a169 !important;
        }
        .tile{cursor:pointer;transition:transform 0.2s,box-shadow 0.2s}
        .tile:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(0,0,0,0.15);border-color:#527ea6}
        
        /* Стили для избранного */
        .good{position:relative}
        
        /* Стили для кликабельных карточек товаров */
        .good {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
        }
        
        .good:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .good a {
            display: block;
            text-decoration: none;
            color: inherit;
        }
        
        .good a:hover {
            text-decoration: none;
        }
        
        /* Стили для кнопок избранного */
        .favorite-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            color: #64748b;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: all 0.2s;
            z-index: 10;
        }
        
        .favorite-btn:hover {
            background: rgba(255, 255, 255, 1);
            transform: scale(1.1);
        }
        
        .favorite-btn.active {
            color: #ef4444;
            background: rgba(255, 255, 255, 1);
        }
        
        .favorite-btn.active:hover {
            transform: scale(1.1);
        }
        
        /* Стили для кнопок корзины */
        .btn[type="submit"] {
            transition: all 0.2s ease;
        }
        
        .btn[type="submit"]:disabled {
            opacity: 0.7;
        }
        
        .btn[type="submit"]:disabled:hover {
            transform: none;
            box-shadow: none;
        }
        
        /* Специальные стили для кнопки "В корзине" */
        .btn[type="submit"]:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        /* Стили для кнопок подкатегорий в модальном окне */
        .subcat-btn:hover {
            background: #f8fafc !important;
            border-color: #527ea6 !important;
            transform: translateY(-1px);
        }
        
        .subcat-btn:active {
            transform: translateY(0);
        }
        
        /* Адаптивность для модального окна избранного */
        .favorites-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }
        
        @media (max-width: 768px) {
            .favorites-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
                margin-bottom: 15px;
            }
            
            .favorites-grid > div {
                padding: 8px !important;
            }
            
            .favorites-grid h4 {
                font-size: 12px !important;
                margin: 0 0 4px 0 !important;
            }
            
            .favorites-grid p {
                font-size: 14px !important;
                margin: 0 0 6px 0 !important;
            }
            
            .favorites-grid button {
                height: 22px !important;
                font-size: 9px !important;
                border-radius: 4px !important;
            }
            
            /* Компактные кнопки удаления */
            .favorites-grid button[onclick*="removeFromFavoritesModal"] {
                height: 20px !important;
                width: 20px !important;
                font-size: 8px !important;
                border-radius: 3px !important;
            }
            
            .favorites-grid img {
                height: 120px !important;
            }
        }
        
        @media (max-width: 480px) {
            .favorites-grid {
                grid-template-columns: 1fr;
                gap: 8px;
                margin-bottom: 12px;
            }
            
            .favorites-grid > div {
                padding: 6px !important;
            }
            
            .favorites-grid h4 {
                font-size: 11px !important;
                margin: 0 0 3px 0 !important;
            }
            
            .favorites-grid p {
                font-size: 13px !important;
                margin: 0 0 4px 0 !important;
            }
            
            .favorites-grid button {
                height: 18px !important;
                font-size: 8px !important;
                border-radius: 3px !important;
            }
            
            /* Еще более компактные кнопки удаления */
            .favorites-grid button[onclick*="removeFromFavoritesModal"] {
                height: 16px !important;
                width: 16px !important;
                font-size: 6px !important;
                border-radius: 2px !important;
            }
            
            .favorites-grid img {
                height: 100px !important;
            }
        }
        
        /* Дополнительные стили для мобильных устройств */
        @media (max-width: 768px) {
            .tile-intro h3 {
                font-size: 18px;
            }
            
            .tile-intro p {
                font-size: 14px;
            }
            
            .tile-custom h3 {
                font-size: 18px;
            }
            
            .tile-custom p {
                font-size: 14px;
            }
            
            .tile-custom p:last-child {
                font-size: 16px;
            }
        }
        
        @media (max-width: 480px) {
            .tile-intro h3 {
                font-size: 16px;
            }
            
            .tile-intro p {
                font-size: 12px;
            }
            
            .tile-custom h3 {
                font-size: 16px;
            }
            
            .tile-custom p {
                font-size: 12px;
            }
            
            .tile-custom p:last-child {
                font-size: 14px;
            }
        }
    </style>
    <script>
        // Функции для модальных окон категорий
        window.showCategoryModal = function(category) {
            const modal = document.getElementById('modal-' + category);
            if (modal) {
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        };
        
        window.closeCategoryModal = function(category) {
            const modal = document.getElementById('modal-' + category);
            if (modal) {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }
        };
        
        // Функция фильтрации товаров в категориях
        function filterCategoryProducts(category) {
            const brandFilter = document.getElementById(category + '-brand-filter').value;
            const priceFilter = document.getElementById(category + '-price-filter').value;
            const products = document.querySelectorAll('#' + category + '-products .product-card');
            
            products.forEach(product => {
                const brand = product.getAttribute('data-brand');
                const price = parseInt(product.getAttribute('data-price'));
                
                let show = true;
                
                if (brandFilter && brand !== brandFilter) show = false;
                if (priceFilter) {
                    const [min, max] = priceFilter.split('-').map(p => p === '+' ? Infinity : parseInt(p));
                    if (price < min || (max !== Infinity && price > max)) show = false;
                }
                
                product.style.display = show ? 'block' : 'none';
            });
        }
        
        // Закрытие модального окна при клике вне его
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.add('hidden');
            }
        }
        
        // Показ уведомлений
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#10b981' : '#3b82f6'};
                color: white;
                padding: 12px 20px;
                border-radius: 8px;
                z-index: 10000;
                font-size: 14px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                transform: translateX(100%);
                transition: transform 0.3s ease;
            `;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => notification.style.transform = 'translateX(0)', 100);
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => document.body.removeChild(notification), 300);
            }, 3000);
        }
        
        // Функции для работы с избранным
        function toggleFavorite(button, title, price, image) {
            button.classList.toggle('active');
            
            if (button.classList.contains('active')) {
                button.innerHTML = '❤';
                button.title = 'Удалить из избранного';
                addToFavorites(title, price, image);
            } else {
                button.innerHTML = '♡';
                button.title = 'Добавить в избранное';
                removeFromFavorites(title);
            }
        }
        
        function addToFavorites(title, price, image) {
            let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const existingIndex = favorites.findIndex(item => item.title === title);
            
            if (existingIndex === -1) {
                favorites.push({ title, price, image });
                localStorage.setItem('favorites', JSON.stringify(favorites));
                showNotification('Товар добавлен в избранное!', 'success');
                updateProductStatuses(); // Обновляем статусы после добавления
            }
        }
        
        function removeFromFavorites(title) {
            let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            favorites = favorites.filter(item => item.title !== title);
            localStorage.setItem('favorites', JSON.stringify(favorites));
            showNotification('Товар удален из избранного', 'info');
            updateProductStatuses(); // Обновляем статусы после удаления
        }
        
        function showFavorites() {
            loadFavoritesContent();
            const modal = document.getElementById('modal-favorites');
            if (modal) {
                modal.classList.remove('hidden');
                console.log('Модальное окно избранного открыто');
            } else {
                console.error('Модальное окно избранного не найдено');
            }
        }
        
        function loadFavoritesContent() {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const content = document.getElementById('favorites-content');
            
            if (favorites.length === 0) {
                content.innerHTML = `
                    <div style="text-align:center;padding:40px 20px;color:#64748b">
                        <div style="font-size:48px;margin-bottom:16px">❤️</div>
                        <h3 style="margin:0 0 8px 0;color:#0f172a">Избранное пусто</h3>
                        <p style="margin:0">Добавляйте товары в избранное, нажимая на сердечко ❤️ рядом с товаром</p>
                    </div>
                `;
            } else {
                let productsHtml = '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:15px;margin-bottom:20px" class="favorites-grid">';
                
                favorites.forEach(item => {
                    productsHtml += `
                        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:10px;overflow:hidden;position:relative">
                            <button onclick="removeFromFavoritesModal('${item.title}')" style="position:absolute;top:8px;right:8px;width:32px;height:32px;border:none;border-radius:50%;background:rgba(255,255,255,0.9);color:#ef4444;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:16px;z-index:10">✕</button>
                            <img src="${item.image}" alt="${item.title}" style="width:100%;height:150px;object-fit:cover">
                            <div style="padding:12px">
                                <h4 style="margin:0 0 6px 0;font-size:14px;font-weight:600">${item.title}</h4>
                                <p style="margin:0 0 8px 0;font-size:16px;font-weight:700;color:#0f172a">${item.price}€</p>
                                <form method="post" action="/cart/add" style="margin:0">
                                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                    <input type="hidden" name="title" value="${item.title}">
                                    <input type="hidden" name="price" value="${item.price}">
                                    <input type="hidden" name="image" value="${item.image}">
                                    <button type="submit" style="width:100%;height:32px;background:#527ea6;color:#fff;border:none;border-radius:6px;font-size:12px;cursor:pointer">В корзину</button>
                                </form>
                            </div>
                        </div>
                    `;
                });
                
                productsHtml += '</div>';
                
                content.innerHTML = productsHtml + `
                    <div style="padding:16px;background:#eef2ff;border-radius:8px;border-left:4px solid #527ea6">
                        <h4 style="margin:0 0 8px 0;color:#1e40af">💡 Избранное</h4>
                        <p style="margin:0;font-size:14px">
                            У вас ${favorites.length} товар${favorites.length === 1 ? '' : favorites.length < 5 ? 'а' : 'ов'} в избранном. 
                            Нажмите "В корзину" для быстрого добавления.
                        </p>
                    </div>
                `;
            }
        }
        
        function removeFromFavoritesModal(title) {
            removeFromFavorites(title);
            loadFavoritesContent();
            
            // Обновляем состояние кнопки на странице
            const button = document.querySelector(`[onclick*="${title}"]`);
            if (button) {
                button.classList.remove('active');
                button.innerHTML = '♡';
                button.title = 'Добавить в избранное';
            }
        }
        
        function clearAllFavorites() {
            if (confirm('Вы уверены, что хотите очистить всё избранное? Это действие нельзя отменить.')) {
                localStorage.removeItem('favorites');
                
                // Сбрасываем все кнопки сердечек на странице
                const favoriteButtons = document.querySelectorAll('.favorite-btn');
                favoriteButtons.forEach(button => {
                    button.classList.remove('active');
                    button.innerHTML = '♡';
                    button.title = 'Добавить в избранное';
                });
                
                // Обновляем содержимое модального окна
                loadFavoritesContent();
                
                showNotification('Всё избранное очищено', 'info');
            }
        }
        
        // Принудительная очистка localStorage (для разработчиков)
        function clearLocalStorage() {
            if (confirm('⚠️ ВНИМАНИЕ! Это очистит ВСЕ данные в localStorage браузера, включая избранное, настройки и другие данные. Продолжить?')) {
                localStorage.clear();
                
                // Сбрасываем все кнопки сердечек
                const favoriteButtons = document.querySelectorAll('.favorite-btn');
                favoriteButtons.forEach(button => {
                    button.classList.remove('active');
                    button.innerHTML = '♡';
                    button.title = 'Добавить в избранное';
                });
                
                // Обновляем страницу для полного сброса
                location.reload();
                
                showNotification('localStorage полностью очищен, страница перезагружена', 'info');
            }
        }
        
        // Простые функции для работы с корзиной и избранным
        function addToCartSimple(productId, quantity, title, price, image) {
            console.log('addToCartSimple called:', {productId, quantity, title, price, image});
            
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const existingItem = cart.find(item => item.title === title);
            
            if (existingItem) {
                existingItem.quantity += quantity;
            } else {
                cart.push({ productId, quantity, title, price, image });
            }
            
            localStorage.setItem('cart', JSON.stringify(cart));
            console.log('Cart updated:', cart);
            
            // Показываем уведомление
            showNotificationSimple('Товар добавлен в корзину', 'success');
            
            // Обновляем счетчики
            updateHeaderCountersSimple();
            
            // Обновляем статус кнопок
            updateProductStatuses();
        }
        
        function toggleFavoriteSimple(productId, title, price, image) {
            console.log('toggleFavoriteSimple called:', {productId, title, price, image});
            
            let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const existingIndex = favorites.findIndex(item => item.title === title);
            
            if (existingIndex > -1) {
                favorites.splice(existingIndex, 1);
                showNotificationSimple('Товар удален из избранного', 'info');
            } else {
                favorites.push({ productId, title, price, image });
                showNotificationSimple('Товар добавлен в избранное', 'success');
            }
            
            localStorage.setItem('favorites', JSON.stringify(favorites));
            console.log('Favorites updated:', favorites);
            
            // Обновляем счетчики
            updateHeaderCountersSimple();
            
            // Обновляем статус кнопок
            updateProductStatuses();
        }
        
        function showNotificationSimple(message, type) {
            console.log('showNotificationSimple called:', message, type);
            
            // Создаем уведомление
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#48bb78' : type === 'error' ? '#f56565' : '#4299e1'};
                color: white;
                padding: 15px 20px;
                border-radius: 8px;
                z-index: 10000;
                font-weight: 600;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                transform: translateX(100%);
                transition: transform 0.3s ease;
            `;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Анимация появления
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            // Удаляем через 3 секунды
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
        
        // НОВАЯ СИСТЕМА ОБНОВЛЕНИЯ СЧЕТЧИКОВ
        async function updateHeaderCountersSimpleNew() {
            try {
                console.log('updateHeaderCountersSimpleNew called');
                
                // Получаем данные корзины с сервера
                const cartResponse = await fetch('/cart/count');
                const cartData = await cartResponse.json();
            
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            
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
            if (cartBadge) {
                    cartBadge.textContent = cartData.count || 0;
                    cartBadge.style.display = (cartData.count || 0) > 0 ? 'block' : 'none';
            }
            
            // Обновляем счетчик корзины - МОБИЛЬНЫЙ
            const mobileCartBadge = document.querySelector('.mobile-cart-badge');
            if (mobileCartBadge) {
                    mobileCartBadge.textContent = cartData.count || 0;
                    mobileCartBadge.style.display = (cartData.count || 0) > 0 ? 'block' : 'none';
                }
                
                console.log('Counters updated:', {favorites: favorites.length, cart: cartData.count || 0});
            } catch (error) {
                console.error('Error updating header counters:', error);
            }
        }
        
        function updateHeaderCountersSimple() {
            console.log('updateHeaderCountersSimple called');
            
            // Используем новую систему обновления счетчиков
            updateHeaderCountersSimpleNew();
        }
        
        // Инициализация избранного при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOMContentLoaded fired on home page');
            
            // Обновляем счетчики
            updateHeaderCountersSimple();
            
            // НОВЫЕ ОБРАБОТЧИКИ ДЛЯ КНОПОК "В КОРЗИНУ"
            const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
            console.log('🔍 Найдено кнопок "В корзину":', addToCartButtons.length);
            
            addToCartButtons.forEach((button, index) => {
                console.log(`🔧 Настраиваем кнопку ${index + 1}`);
                
                button.addEventListener('click', async function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    console.log('🖱️ Клик по кнопке "В корзину"');
                    
                    // Получаем информацию о товаре из родительского элемента
                    const productCard = button.closest('.product-card');
                    if (!productCard) {
                        console.error('❌ Не найден .product-card');
                        return;
                    }
                    
                    const title = productCard.querySelector('h4')?.textContent?.trim() || '';
                    const priceText = productCard.querySelector('.price')?.textContent?.trim() || '0€';
                    const price = parseFloat(priceText.replace('€', '').replace(',', '.'));
                    const image = productCard.querySelector('img')?.src || '';
                    const brand = productCard.dataset.brand || '';
                    
                    console.log('📦 Данные товара:', { title, priceText, price, image, brand });
                    
                    if (!title) {
                        console.error('❌ Не найдено название товара');
                        showNotification('Ошибка: не найдено название товара', 'error');
                        return;
                    }
                    
                    // Получаем реальный ID товара из базы данных по названию через API
                    try {
                        const response = await fetch(`/cart/product-id?title=${encodeURIComponent(title)}`);
                        const data = await response.json();
                        
                        if (data.success) {
                            console.log('🆔 Product ID from API:', data.product_id);
                            
                            // Добавляем товар в корзину через новую систему
                            await addToCartNew(data.product_id, data.title, data.price, data.image);
                        } else {
                            console.error('❌ Error getting product ID:', data.error);
                            showNotification('Ошибка при получении ID товара', 'error');
                        }
                    } catch (error) {
                        console.error('❌ Error fetching product ID:', error);
                        showNotification('Ошибка при получении ID товара', 'error');
                    }
                });
            });
            
            // Обработчики для форм добавления в корзину
            const cartForms = document.querySelectorAll('form[action="/cart/add"]');
            console.log('Found cart forms:', cartForms.length);
            cartForms.forEach((form, index) => {
                console.log(`Setting up cart form ${index}:`, form);
                form.addEventListener('submit', function(e) {
                    console.log('Cart form submitted', e);
                    e.preventDefault();
                    
                    const formData = new FormData(form);
                    const title = formData.get('title');
                    const price = formData.get('price');
                    const image = formData.get('image');
                    
                    console.log('Form data:', { title, price, image });
                    
                    // Получаем реальный ID товара из базы данных по названию
                    const productId = getProductIdByTitle(title);
                    
                    console.log('Adding to cart:', { productId, title, price, image, brand });
                    
                    // Добавляем товар в корзину через API
                    addToCart(productId, title, price, image);
                });
            });
            
            // Обработчики для форм избранного
            const favoriteForms = document.querySelectorAll('form[action="/favorites/add"]');
            console.log('Found favorite forms:', favoriteForms.length);
            favoriteForms.forEach((form, index) => {
                console.log(`Setting up favorite form ${index}:`, form);
                form.addEventListener('submit', function(e) {
                    console.log('Favorite form submitted', e);
                    e.preventDefault();
                    
                    const formData = new FormData(form);
                    const title = formData.get('title');
                    const price = formData.get('price');
                    const image = formData.get('image');
                    
                    console.log('Favorite form data:', { title, price, image });
                    
                    // Используем простую функцию переключения избранного
                    toggleFavoriteSimple(null, title, price, image);
                });
            });
        });
        
        // Используем глобальную функцию updateHeaderCounters из хедера
        
        // Функция для обновления статуса всех товаров
        // НОВАЯ СИСТЕМА ОБНОВЛЕНИЯ СТАТУСОВ ТОВАРОВ
        async function updateProductStatusesNew() {
            try {
                console.log('updateProductStatusesNew called');
                
                // Получаем количество товаров в корзине
                const cartCountResponse = await fetch('/cart/count');
                const cartCountData = await cartCountResponse.json();
                
                console.log('Cart count from server:', cartCountData.count);
                
                // Если корзина пуста, сбрасываем все кнопки
                if (cartCountData.count === 0) {
                    const cartButtons = document.querySelectorAll('.add-to-cart-btn');
                    cartButtons.forEach(button => {
                        button.innerHTML = 'В корзину';
                        button.style.background = '#527ea6';
                        button.style.color = '#ffffff';
                        button.style.fontWeight = '600';
                        button.disabled = false;
                    });
                    return;
                }
            
            // Обновляем кнопки корзины
            const cartButtons = document.querySelectorAll('form[action="/cart/add"] button');
            cartButtons.forEach(button => {
                const form = button.closest('form');
                const titleInput = form.querySelector('input[name="title"]');
                const title = titleInput ? titleInput.value : '';
                
                if (title) {
                        const isInCart = cartItems.some(item => item.title === title);
                    
                    if (isInCart) {
                        button.innerHTML = 'В корзине';
                        button.style.background = '#48bb78';
                        button.style.color = '#ffffff';
                        button.style.fontWeight = '600';
                        button.style.cursor = 'pointer';
                        button.disabled = false;
                        button.title = 'Нажмите, чтобы удалить из корзины';
                        
                        // Удаляем старый обработчик и добавляем новый
                        button.removeEventListener('click', button.cartRemoveHandler);
                        button.cartRemoveHandler = function(e) {
                            e.preventDefault();
                            removeFromCartSimple(null, title);
                        };
                        button.addEventListener('click', button.cartRemoveHandler);
                    } else {
                        button.innerHTML = 'Добавить в корзину';
                        button.style.background = '#527ea6';
                        button.style.color = '#ffffff';
                        button.style.fontWeight = '600';
                        button.style.cursor = 'pointer';
                        button.disabled = false;
                        button.title = 'Добавить в корзину';
                        
                        // Удаляем обработчик удаления
                        button.removeEventListener('click', button.cartRemoveHandler);
                        delete button.cartRemoveHandler;
                            
                            // Добавляем обработчик добавления в корзину
                            button.cartAddHandler = function(e) {
                                e.preventDefault();
                                const priceInput = form.querySelector('input[name="price"]');
                                const imageInput = form.querySelector('input[name="image"]');
                                const price = priceInput ? priceInput.value : '0';
                                const image = imageInput ? imageInput.value : '';
                                addToCartNew(null, title, price, image);
                            };
                            button.addEventListener('click', button.cartAddHandler);
                    }
                }
            });
            
                console.log('Product statuses updated');
            } catch (error) {
                console.error('Error updating product statuses:', error);
            }
        }
        
        function updateProductStatuses() {
            console.log('updateProductStatuses called');
            
            // Используем новую систему обновления статусов
            updateProductStatusesNew();
        }
        
        // Функция для удаления товара из корзины
        // НОВАЯ СИСТЕМА УДАЛЕНИЯ ИЗ КОРЗИНЫ
        async function removeFromCartNew(productId, title) {
            try {
                console.log('=== УДАЛЕНИЕ ИЗ КОРЗИНЫ ===');
                console.log('Product ID:', productId);
                console.log('Title:', title);
                
                // Получаем CSRF токен
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (!csrfToken) {
                    throw new Error('CSRF token not found');
                }
                
                console.log('CSRF Token:', csrfToken.getAttribute('content'));
                
                // Отправляем запрос на сервер
                const response = await fetch('/cart/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        size: null
                    })
                });

                console.log('Response status:', response.status);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                console.log('Response data:', data);
                
                if (data.success) {
                    console.log('✅ Товар успешно удален из корзины');
                    showNotificationSimple('Товар удален из корзины!', 'success');
                
                // Обновляем счетчики
                    updateCartCounters(data.cart_count, data.cart_total);
                    
                    // Если мы на странице корзины, перезагружаем корзину
                    if (typeof CartManager !== 'undefined' && CartManager.loadCart) {
                        CartManager.loadCart();
                    }
                
                // Обновляем статус кнопок
                updateProductStatuses();
                } else {
                    console.error('❌ Ошибка:', data.message);
                    showNotificationSimple(data.message || 'Ошибка при удалении товара', 'error');
                }
            } catch (error) {
                console.error('❌ Критическая ошибка:', error);
                showNotificationSimple('Ошибка: ' + error.message, 'error');
            }
        }
        
        function removeFromCartSimple(productId, title) {
            console.log('removeFromCartSimple called:', {productId, title});
            
            // Получаем ID товара по названию
            const productIdFromTitle = getProductIdByTitle(title);
            
            // Используем новую систему удаления
            removeFromCartNew(productIdFromTitle, title);
        }
        
        // Старые функции удалены - теперь используются из common-functions.js
        
        // Функция для очистки корзины
        function clearCart() {
            if (confirm('Вы уверены, что хотите очистить корзину?')) {
                localStorage.removeItem('cart');
                if (typeof showNotification === 'function') {
                    showNotification('Корзина очищена', 'info');
                }
                updateProductStatuses(); // Обновляем статусы
            }
        }
        
        // Простейшие табы + фильтры без перезагрузки
        document.addEventListener('DOMContentLoaded', () => {
            const tabMen = document.getElementById('tab-men');
            const tabWomen = document.getElementById('tab-women');
            const cards = document.querySelectorAll('[data-section]');
            const goods = Array.from(document.querySelectorAll('#goods .good'));
            const categoryList = document.getElementById('categoryList');
            const brandList = document.getElementById('brandList');
            const priceMin = document.getElementById('priceMin');
            const priceMax = document.getElementById('priceMax');
            const resetBtn = document.getElementById('resetFilters');

            // Табы
            function setTab(target){
                tabMen.classList.toggle('active', target==='men');
                tabWomen.classList.toggle('active', target==='women');
                cards.forEach(c=>{
                    const section=c.getAttribute('data-section');
                    c.style.display = (target==='men' && section==='men') || (target==='women' && section==='women') ? '' : 'none';
                });
            }
            tabMen?.addEventListener('click',()=>setTab('men'));
            tabWomen?.addEventListener('click',()=>setTab('women'));
            setTab('men');

            // Аккордеоны фильтров
            document.querySelectorAll('.filter-group .filter-head').forEach(head => {
                head.addEventListener('click', () => head.parentElement.classList.toggle('open'));
            });

            // Состояние фильтров
            const state = { category: 'all', brands: new Set(), subcats: new Set(), min: '', max: '' };

            function toggleItem(el, set, isSingle=false){
                if(isSingle){
                    el.parentElement.querySelectorAll('.filter-item').forEach(i=>i.classList.remove('active'));
                    el.classList.add('active');
                } else {
                    el.classList.toggle('active');
                    const val = el.dataset.value;
                    if(el.classList.contains('active')) set.add(val); else set.delete(val);
                }
                applyFilters();
            }

            categoryList?.addEventListener('click', e => {
                const el = e.target.closest('.filter-item');
                if(!el) return; 
                
                const category = el.dataset.value;
                if (category === 'all') {
                    state.category = 'all';
                    toggleItem(el, null, true);
                } else {
                    // Открываем модальное окно с подкатегориями для выбранной категории
                    showSubcategoriesModal(category);
                }
            });
            brandList?.addEventListener('click', e => {
                const el = e.target.closest('.filter-item');
                if(!el) return; toggleItem(el, state.brands);
            });
            priceMin?.addEventListener('input', e => { state.min = e.target.value; applyFilters(); });
            priceMax?.addEventListener('input', e => { state.max = e.target.value; applyFilters(); });
            resetBtn?.addEventListener('click', () => {
                state.category = 'all'; state.brands.clear(); state.subcats.clear(); state.min = state.max = '';
                document.querySelectorAll('.filter-item').forEach(i=>i.classList.remove('active'));
                categoryList?.querySelector('[data-value="all"]').classList.add('active');
                if(priceMin) priceMin.value = '';
                if(priceMax) priceMax.value = '';
                applyFilters();
            });

            function showSubcategoriesModal(category) {
                const subcategories = getSubcategoriesForCategory(category);
                const modalContent = `
                    <div class="modal-content" style="max-width:500px">
                        <span class="close">&times;</span>
                        <h2>Подкатегории: ${category}</h2>
                        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:10px;margin-top:20px">
                            ${subcategories.map(subcat => `
                                <button class="subcat-btn" onclick="selectSubcategory('${category}', '${subcat}')" 
                                        style="padding:12px;border:1px solid #cbd5e1;border-radius:8px;background:#fff;cursor:pointer;text-align:left;transition:all 0.2s">
                                    ${subcat}
                                </button>
                            `).join('')}
                        </div>
                    </div>
                `;
                
                // Создаем или обновляем модальное окно
                let modal = document.getElementById('modal-subcategories');
                if (!modal) {
                    modal = document.createElement('div');
                    modal.id = 'modal-subcategories';
                    modal.className = 'modal hidden';
                    document.body.appendChild(modal);
                }
                modal.innerHTML = modalContent;
                modal.classList.remove('hidden');
            }
            
            function getSubcategoriesForCategory(category) {
                const subcategoriesMap = {
                    'Одежда': ['Зип-худи', 'Футболки', 'Джинсы', 'Шорты', 'Пальто', 'Куртки', 'Рубашки', 'Свитера'],
                    'Обувь': ['Лоферы', 'Кеды', 'Кроссовки', 'Ботинки', 'Сандалии', 'Туфли'],
                    'Сумки': ['Сумка через плечо', 'Рюкзак', 'Клатч', 'Торба', 'Кошелек', 'Дорожная сумка'],
                    'Часы': ['Механические', 'Кварцевые', 'Автоматические', 'Хронограф', 'Смарт-часы'],
                    'Украшения': ['Кольца', 'Браслеты', 'Цепочки', 'Серьги', 'Подвески', 'Броши'],
                    'Аксессуары': ['Очки', 'Ремни', 'Галстуки', 'Шарфы', 'Перчатки', 'Зонты']
                };
                return subcategoriesMap[category] || [];
            }
            
            function selectSubcategory(category, subcategory) {
                // Устанавливаем категорию и подкатегорию
                state.category = category;
                state.subcats.clear();
                state.subcats.add(subcategory);
                
                // Обновляем активные элементы в фильтрах
                document.querySelectorAll('.filter-item').forEach(item => {
                    item.classList.remove('active');
                });
                
                // Активируем выбранную категорию
                const categoryItem = categoryList?.querySelector(`[data-value="${category}"]`);
                if (categoryItem) categoryItem.classList.add('active');
                
                // Закрываем модальное окно
                closeModal('subcategories');
                
                // Применяем фильтры
                applyFilters();
            }
            
            function applyFilters(){
                const min = state.min ? Number(state.min) : -Infinity;
                const max = state.max ? Number(state.max) : Infinity;
                goods.forEach(card => {
                    const c = card.dataset.category;
                    const b = card.dataset.brand;
                    const s = card.dataset.subcat;
                    const p = Number(card.dataset.price);
                    const byCategory = state.category==='all' || state.category===c;
                    const byBrand = state.brands.size===0 || state.brands.has(b);
                    const bySub = state.subcats.size===0 || state.subcats.has(s);
                    const byPrice = p>=min && p<=max;
                    card.style.display = (byCategory && byBrand && bySub && byPrice) ? '' : 'none';
                });
            }
            applyFilters();
            
            // Восстанавливаем состояние кнопок корзины и избранного при загрузке страницы
            setTimeout(() => {
                updateProductStatuses();
                updateHeaderCountersSimple();
            }, 100);
        });
        
        // ========== НОВАЯ ЛОГИКА МОДАЛЬНЫХ ОКОН ==========
        (function() {
            'use strict';
            
            const ModalManager = {
                // Открыть модальное окно
                open: function(modalId) {
                    const modal = document.getElementById('modal-' + modalId);
                    if (!modal) {
                        console.error('Modal not found:', modalId);
                        return;
                    }
                    
                    // Добавляем класс active
                    modal.classList.add('active');
                    // Блокируем скролл body
                    document.body.style.overflow = 'hidden';
                    
                    console.log('Modal opened:', modalId);
                },
                
                // Закрыть модальное окно
                close: function(modalElement) {
                    if (!modalElement) return;
                    
                    // Убираем класс active
                    modalElement.classList.remove('active');
                    // Возвращаем скролл body
                    document.body.style.overflow = '';
                    
                    console.log('Modal closed:', modalElement.id);
                },
                
                // Закрыть все модальные окна
                closeAll: function() {
                    const modals = document.querySelectorAll('.modal-overlay.active');
                    modals.forEach(modal => this.close(modal));
                },
                
                // Инициализация
                init: function() {
                    // Закрытие по кнопке закрытия
                    document.addEventListener('click', (e) => {
                        if (e.target.classList.contains('modal-close')) {
                            const modal = e.target.closest('.modal-overlay');
                            if (modal) {
                                this.close(modal);
                            }
                        }
                    });
                    
                    // Закрытие по клику на оверлей (фон)
                    document.addEventListener('click', (e) => {
                        if (e.target.classList.contains('modal-overlay')) {
                            this.close(e.target);
                        }
                    });
                    
                    // Закрытие по Escape
                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'Escape' || e.key === 'Esc') {
                            this.closeAll();
                        }
                    });
                    
                    console.log('Modal Manager initialized');
                }
            };
            
            // Глобальные функции для обратной совместимости
            window.showModal = function(modalId) {
                ModalManager.open(modalId);
            };
            
            window.closeModal = function(modalId) {
                const modal = document.getElementById('modal-' + modalId);
                ModalManager.close(modal);
            };
            
            // Инициализация при загрузке DOM
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', () => ModalManager.init());
            } else {
                ModalManager.init();
            }
        })();
        
        // Функция для получения ID товара по названию
        function getProductIdByTitle(title) {
            // Маппинг статичных товаров к реальным ID из БД
            const productMap = {
                'Stone Island худи': 4,
                'Balenciaga худи': 4,
                'Gucci куртка': 4,
                'Nike Air Force 1': 1,
                'Adidas Yeezy': 3,
                'Balenciaga Triple S': 1,
                'Balenciaga сумка': 2,
                'Gucci сумка': 2,
                'Cartier браслет': 2,
                'Tiffany кольцо': 2,
                'Gucci ремень': 2,
                'Hermes кошелек': 2,
                'Rolex Daytona': 5,
                'Omega Speedmaster': 5
            };
            
            return productMap[title] || 1; // По умолчанию ID 1
        }
        
        // НОВАЯ СИСТЕМА ДОБАВЛЕНИЯ В КОРЗИНУ
        async function addToCartNew(productId, title, price, image) {
            try {
                console.log('=== ДОБАВЛЕНИЕ В КОРЗИНУ ===');
                console.log('Product ID:', productId);
                console.log('Title:', title);
                console.log('Price:', price);
                console.log('Image:', image);
                
                // Получаем CSRF токен
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (!csrfToken) {
                    throw new Error('CSRF token not found');
                }
                
                console.log('CSRF Token:', csrfToken.getAttribute('content'));
                
                // Отправляем запрос на сервер
                const response = await fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        title: title,
                        price: price,
                        image: image,
                        quantity: 1
                    })
                });

                console.log('Response status:', response.status);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                console.log('Response data:', data);
                
                if (data.success) {
                    console.log('✅ Товар успешно добавлен в корзину');
                    showNotificationSimple('Товар добавлен в корзину!', 'success');
                    
                    // Обновляем счетчики
                    updateCartCounters(data.cart_count, data.cart_total);
                    
                    // Если мы на странице корзины, перезагружаем корзину
                    if (typeof CartManager !== 'undefined' && CartManager.loadCart) {
                        CartManager.loadCart();
                    }
                } else if (data.requires_auth) {
                    console.log('🔒 Требуется авторизация');
                    showAuthModal();
                } else {
                    console.error('❌ Ошибка:', data.message);
                    showNotificationSimple(data.message || 'Ошибка при добавлении товара', 'error');
                }
            } catch (error) {
                console.error('❌ Критическая ошибка:', error);
                showNotificationSimple('Ошибка: ' + error.message, 'error');
            }
        }
        
        // Обновление счетчиков корзины
        function updateCartCounters(count, total) {
            console.log('Обновляем счетчики:', { count, total });
            
            // Обновляем счетчик в хедере
            const cartBadge = document.getElementById('cart-badge');
            if (cartBadge) {
                cartBadge.textContent = count;
                cartBadge.style.display = count > 0 ? 'block' : 'none';
            }
            
            // Обновляем мобильный счетчик
            const mobileCartBadge = document.querySelector('.mobile-cart-badge');
            if (mobileCartBadge) {
                mobileCartBadge.textContent = count;
                mobileCartBadge.style.display = count > 0 ? 'block' : 'none';
            }
        }

        // Функция для показа модального окна авторизации
        function showAuthModal() {
            const modal = document.getElementById('auth-modal');
            if (modal) {
                modal.style.display = 'block';
            }
        }

        // Функция для закрытия модального окна авторизации
        function closeAuthModal() {
            const modal = document.getElementById('auth-modal');
            if (modal) {
                modal.style.display = 'none';
            }
        }
    </script>
@section('content')
@php
$auth = session('auth');
@endphp

<div class="container">
    <div class="grid-top">
        <div class="tile tile-intro" style="background:rgb(226,223,244);cursor:pointer" onclick="showModal('order')">
            <h3>Знакомство. Оформление заказа</h3>
    
            </div>
            <div class="tile tile-custom" style="background:rgb(204,215,227);cursor:pointer" onclick="showModal('custom')">
                <h3>ЛЮБАЯ МОДЕЛЬ</h3>
                <h3>ПОД ЗАКАЗ</h3>
                <h3>В 10 раз дешевле</h3>
            </div>
        </div>

        <!-- Модальные окна для кнопок - НОВАЯ СТРУКТУРА -->
        <div id="modal-order" class="modal-overlay">
            <div class="modal-dialog">
                <div class="modal-header">
                    <h2>Знакомство. Оформление заказа</h2>
                    <button class="modal-close" data-modal="modal-order" type="button">&times;</button>
                </div>
                <div class="modal-body">
                    <h3>Как мы работаем:</h3>
                    <ul style="margin:16px 0;padding-left:20px">
                        <li>Выбираете товар из нашего каталога</li>
                        <li>Добавляете в корзину</li>
                        <li>Оформляете заказ через корзину</li>
                        <li>Получаете подтверждение на email</li>
                        <li>Мы связываемся с вами для уточнения деталей</li>
                    </ul>
                    
                    <h3>Как оформить покупку:</h3>
                    <ul style="margin:16px 0;padding-left:20px">
                        <li>Войдите в аккаунт или зарегистрируйтесь</li>
                        <li>Выберите товары и добавьте в корзину</li>
                        <li>Перейдите в корзину и проверьте заказ</li>
                        <li>Укажите адрес доставки и способ оплаты</li>
                        <li>Подтвердите заказ</li>
                    </ul>
                    
                    <p style="margin-top:20px;padding:12px;background:#f1f5f9;border-radius:8px;font-weight:600">
                        💡 <strong>Совет:</strong> Для быстрого оформления заказа убедитесь, что у вас есть актуальные контактные данные.
                    </p>
                </div>
            </div>
        </div>

        <div id="modal-custom" class="modal-overlay">
            <div class="modal-dialog">
                <div class="modal-header">
                    <h2>Любая модель под заказ</h2>
                    <button class="modal-close" data-modal="modal-custom" type="button">&times;</button>
                </div>
                <div class="modal-body">
                    <h3>Почему в 10 раз дешевле:</h3>
                    <ul style="margin:16px 0;padding-left:20px">
                        <li>Работаем напрямую с производителями</li>
                        <li>Отсутствие посредников и наценок</li>
                        <li>Оптовые закупки снижают стоимость</li>
                        <li>Собственные склады и логистика</li>
                    </ul>
                    
                    <h3>Как заказать любую модель:</h3>
                    <ul style="margin:16px 0;padding-left:20px">
                        <li>Найдите нужную модель в интернете</li>
                        <li>Отправьте нам ссылку или фото</li>
                        <li>Укажите размер и цвет</li>
                        <li>Получите точную стоимость</li>
                        <li>Оплатите и ждите доставки</li>
                    </ul>
                    
                    <div style="margin-top:20px;padding:16px;background:#eef2ff;border-radius:8px;border-left:4px solid #527ea6">
                        <h4 style="margin:0 0 8px 0;color:#1e40af">🎯 Специальное предложение</h4>
                        <p style="margin:0;font-size:14px">
                            При заказе от 3-х товаров - скидка 15%! 
                            При заказе от 5-ти товаров - скидка 25%!
                        </p>
                    </div>
                    
                    <div style="margin-top:20px;text-align:center">
                        <a href="https://t.me/OLS_Managerr" target="_blank" class="telegram-btn">
                            <span>📱</span>
                            <span>Связаться с менеджером в Telegram</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>



        <!-- Модальные окна категорий - НОВАЯ СТРУКТУРА -->
        <div id="modal-clothing" class="modal-overlay">
            <div class="modal-dialog" style="max-width:800px">
                <div class="modal-header">
                    <h2>Каталог одежды</h2>
                    <button class="modal-close" data-modal="modal-clothing" type="button">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Фильтры -->
                    <div class="modal-filters">
                        <div class="filter-row">
                            <select id="clothing-brand-filter" onchange="filterCategoryProducts('clothing')">
                                <option value="">Все бренды</option>
                                <option value="Stone Island">Stone Island</option>
                                <option value="Balenciaga">Balenciaga</option>
                                <option value="Gucci">Gucci</option>
                            </select>
                            <select id="clothing-price-filter" onchange="filterCategoryProducts('clothing')">
                                <option value="">Любая цена</option>
                                <option value="0-50">До 50€</option>
                                <option value="50-100">50-100€</option>
                                <option value="100+">От 100€</option>
                            </select>
                        </div>
                    </div>

                    <!-- Товары -->
                    <div class="modal-products" id="clothing-products">
                        <div class="product-card" data-brand="Stone Island" data-price="60">
                            <img src="https://media.endclothing.com/media/f_auto,q_auto:eco,w_1600/prodmedia/media/catalog/product/0/5/05-08-2021_TH_751560519-V0029_1_1.jpg" alt="Stone Island худи">
                            <div class="product-info">
                                <h4>Stone Island худи</h4>
                                <p class="price">60€</p>
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        
                        <div class="product-card" data-brand="Balenciaga" data-price="85">
                            <img src="https://media.endclothing.com/media/f_auto,q_auto:eco,w_1600/prodmedia/media/catalog/product/0/5/05-01-2018_stoneisland_juniorgarmentdyedziphoody_black_6716-62040-v0029_th_1x.jpg" alt="Balenciaga худи">
                            <div class="product-info">
                                <h4>Balenciaga худи</h4>
                                <p class="price">85€</p>
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                        
                        <div class="product-card" data-brand="Gucci" data-price="120">
                            <img src="https://media.endclothing.com/media/f_auto,q_auto:eco,w_1600/prodmedia/media/catalog/product/0/5/05-08-2021_TH_751560519-V0029_1_1.jpg" alt="Gucci куртка">
                            <div class="product-info">
                                <h4>Gucci куртка</h4>
                                <p class="price">120€</p>
                                <button class="add-to-cart-btn">В корзину</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-shoes" class="modal-overlay">
            <div class="modal-dialog" style="max-width:800px">
                <div class="modal-header">
                    <h2>Каталог обуви</h2>
                    <button class="modal-close" data-modal="modal-shoes" type="button">&times;</button>
                </div>
                <div class="modal-body">
                
                <!-- Фильтры -->
                <div class="modal-filters">
                    <div class="filter-row">
                        <select id="shoes-brand-filter" onchange="filterCategoryProducts('shoes')">
                            <option value="">Все бренды</option>
                            <option value="Nike">Nike</option>
                            <option value="Adidas">Adidas</option>
                            <option value="Balenciaga">Balenciaga</option>
                        </select>
                        <select id="shoes-price-filter" onchange="filterCategoryProducts('shoes')">
                            <option value="">Любая цена</option>
                            <option value="0-50">До 50€</option>
                            <option value="50-100">50-100€</option>
                            <option value="100+">От 100€</option>
                        </select>
                    </div>
                </div>

                <!-- Товары -->
                <div class="modal-products" id="shoes-products">
                    <div class="product-card" data-brand="Nike" data-price="45">
                        <img src="https://i.ebayimg.com/images/g/K6YAAOSw-0pkpWG2/s-l1600.jpg" alt="Nike Air Force 1">
                        <div class="product-info">
                            <h4>Nike Air Force 1</h4>
                            <p class="price">45€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Adidas" data-price="55">
                        <img src="https://akn-fashfed.a-cdn.akinoncloud.com/products/2024/01/29/72381571/53803750-7e5e-4192-884f-bef928c95a1c_size2000x2000_cropCenter.jpg" alt="Adidas Yeezy">
                        <div class="product-info">
                            <h4>Adidas Yeezy</h4>
                            <p class="price">55€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Balenciaga" data-price="95">
                        <img src="https://i.ebayimg.com/images/g/K6YAAOSw-0pkpWG2/s-l1600.jpg" alt="Balenciaga Triple S">
                        <div class="product-info">
                            <h4>Balenciaga Triple S</h4>
                            <p class="price">95€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div id="modal-bags" class="modal-overlay">
            <div class="modal-dialog" style="max-width:800px">
                <div class="modal-header">
                    <h2>Каталог сумок</h2>
                    <button class="modal-close" data-modal="modal-bags" type="button">&times;</button>
                </div>
                <div class="modal-body">
                
                <!-- Фильтры -->
                <div class="modal-filters">
                    <div class="filter-row">
                        <select id="bags-brand-filter" onchange="filterCategoryProducts('bags')">
                            <option value="">Все бренды</option>
                            <option value="Balenciaga">Balenciaga</option>
                            <option value="Gucci">Gucci</option>
                            <option value="Louis Vuitton">Louis Vuitton</option>
                        </select>
                        <select id="bags-price-filter" onchange="filterCategoryProducts('bags')">
                            <option value="">Любая цена</option>
                            <option value="0-50">До 50€</option>
                            <option value="50-100">50-100€</option>
                            <option value="100+">От 100€</option>
                        </select>
                    </div>
                </div>

                <!-- Товары -->
                <div class="modal-products" id="bags-products">
                    <div class="product-card" data-brand="Balenciaga" data-price="80">
                        <img src="https://s3-eu-west-1.amazonaws.com/img.frmoda.com/borse/balenciaga/4823/4823892JMF71000nero-01.jpg" alt="Balenciaga сумка">
                        <div class="product-info">
                            <h4>Balenciaga сумка</h4>
                            <p class="price">80€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Gucci" data-price="110">
                        <img src="https://s3-eu-west-1.amazonaws.com/img.frmoda.com/borse/balenciaga/4823/4823892JMF71000nero-01.jpg" alt="Gucci сумка">
                        <div class="product-info">
                            <h4>Gucci сумка</h4>
                            <p class="price">110€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div id="modal-jewelry" class="modal-overlay">
            <div class="modal-dialog" style="max-width:800px">
                <div class="modal-header">
                    <h2>Каталог украшений</h2>
                    <button class="modal-close" data-modal="modal-jewelry" type="button">&times;</button>
                </div>
                <div class="modal-body">
                
                <!-- Фильтры -->
                <div class="modal-filters">
                    <div class="filter-row">
                        <select id="jewelry-brand-filter" onchange="filterCategoryProducts('jewelry')">
                            <option value="">Все бренды</option>
                            <option value="Cartier">Cartier</option>
                            <option value="Tiffany">Tiffany</option>
                        </select>
                        <select id="jewelry-price-filter" onchange="filterCategoryProducts('jewelry')">
                            <option value="">Любая цена</option>
                            <option value="0-50">До 50€</option>
                            <option value="50-100">50-100€</option>
                            <option value="100+">От 100€</option>
                        </select>
                    </div>
                </div>

                <!-- Товары -->
                <div class="modal-products" id="jewelry-products">
                    <div class="product-card" data-brand="Cartier" data-price="75">
                        <img src="https://avatars.mds.yandex.net/i?id=998c7a6e6b4da23a6ace208d71d1df9c_l-6949821-images-thumbs&n=13" alt="Cartier браслет">
                        <div class="product-info">
                            <h4>Cartier браслет</h4>
                            <p class="price">75€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Tiffany" data-price="90">
                        <img src="https://avatars.mds.yandex.net/i?id=998c7a6e6b4da23a6ace208d71d1df9c_l-6949821-images-thumbs&n=13" alt="Tiffany кольцо">
                        <div class="product-info">
                            <h4>Tiffany кольцо</h4>
                            <p class="price">90€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div id="modal-accessories" class="modal-overlay">
            <div class="modal-dialog" style="max-width:800px">
                <div class="modal-header">
                    <h2>Каталог аксессуаров</h2>
                    <button class="modal-close" data-modal="modal-accessories" type="button">&times;</button>
                </div>
                <div class="modal-body">
                
                <!-- Фильтры -->
                <div class="modal-filters">
                    <div class="filter-row">
                        <select id="accessories-brand-filter" onchange="filterCategoryProducts('accessories')">
                            <option value="">Все бренды</option>
                            <option value="Gucci">Gucci</option>
                            <option value="Hermes">Hermes</option>
                        </select>
                        <select id="accessories-price-filter" onchange="filterCategoryProducts('accessories')">
                            <option value="">Любая цена</option>
                            <option value="0-50">До 50€</option>
                            <option value="50-100">50-100€</option>
                            <option value="100+">От 100€</option>
                        </select>
                    </div>
                </div>

                <!-- Товары -->
                <div class="modal-products" id="accessories-products">
                    <div class="product-card" data-brand="Gucci" data-price="65">
                        <img src="https://i.ebayimg.com/images/g/eEkAAOSwWCBnxyC~/s-l1600.jpg" alt="Gucci ремень">
                        <div class="product-info">
                            <h4>Gucci ремень</h4>
                            <p class="price">65€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Hermes" data-price="85">
                        <img src="https://i.ebayimg.com/images/g/eEkAAOSwWCBnxyC~/s-l1600.jpg" alt="Hermes кошелек">
                        <div class="product-info">
                            <h4>Hermes кошелек</h4>
                            <p class="price">85€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div id="modal-watches" class="modal-overlay">
            <div class="modal-dialog" style="max-width:800px">
                <div class="modal-header">
                    <h2>Каталог часов</h2>
                    <button class="modal-close" data-modal="modal-watches" type="button">&times;</button>
                </div>
                <div class="modal-body">
                
                <!-- Фильтры -->
                <div class="modal-filters">
                    <div class="filter-row">
                        <select id="watches-brand-filter" onchange="filterCategoryProducts('watches')">
                            <option value="">Все бренды</option>
                            <option value="Rolex">Rolex</option>
                            <option value="Omega">Omega</option>
                        </select>
                        <select id="watches-price-filter" onchange="filterCategoryProducts('watches')">
                            <option value="">Любая цена</option>
                            <option value="0-100">До 100€</option>
                            <option value="100-200">100-200€</option>
                            <option value="200+">От 200€</option>
                        </select>
                    </div>
                </div>

                <!-- Товары -->
                <div class="modal-products" id="watches-products">
                    <div class="product-card" data-brand="Rolex" data-price="150">
                        <img src="https://cdn.staticscc.com/uploads/103804/cart/resources/20241115/A14E3A2E-E65C-D30C-AF26-5919EEDB736F.png" alt="Rolex Daytona">
                        <div class="product-info">
                            <h4>Rolex Daytona</h4>
                            <p class="price">150€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                    
                    <div class="product-card" data-brand="Omega" data-price="120">
                        <img src="https://cdn.staticscc.com/uploads/103804/cart/resources/20241115/A14E3A2E-E65C-D30C-AF26-5919EEDB736F.png" alt="Omega Speedmaster">
                        <div class="product-info">
                            <h4>Omega Speedmaster</h4>
                            <p class="price">120€</p>
                            <button class="add-to-cart-btn">В корзину</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- Модальные окна для кнопок шапки -->
        <div id="modal-faq" class="modal hidden">
            <div class="modal-content" style="max-width:600px">
                <span class="close">&times;</span>
                <h2>Часто задаваемые вопросы (FAQ)</h2>
                <div style="line-height:1.6;color:#475569">
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">❓ Как заказать товар?</h3>
                        <p>Выберите товар, добавьте в корзину и оформите заказ. Мы свяжемся с вами для уточнения деталей.</p>
                    </div>
                    
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">❓ Какие способы оплаты?</h3>
                        <p>Принимаем оплату картой, наличными при получении, банковским переводом.</p>
                    </div>
                    
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">❓ Сколько стоит доставка?</h3>
                        <p>Доставка по городу - 5€, по стране - 10€. При заказе от 100€ - доставка бесплатно.</p>
                    </div>
                    
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">❓ Можно ли вернуть товар?</h3>
                        <p>Да, в течение 14 дней с момента получения товара.</p>
                    </div>
                    
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">❓ Есть ли гарантия качества?</h3>
                        <p>Да, все товары проходят проверку качества перед отправкой.</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-contact" class="modal hidden">
            <div class="modal-content" style="max-width:600px">
                <span class="close">&times;</span>
                <h2>Контактная информация</h2>
                <div style="line-height:1.6;color:#475569">
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">📞 Телефон</h3>
                        <p>+7 (999) 123-45-67</p>
                        <p style="font-size:14px;color:#64748b">Пн-Пт: 9:00-18:00, Сб-Вс: 10:00-16:00</p>
                    </div>
                    
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">✉️ Email</h3>
                        <p>info@original-lux-shop.com</p>
                        <p>support@original-lux-shop.com</p>
                    </div>
                    
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">📍 Адрес</h3>
                        <p>ул. Примерная, д. 123, офис 45</p>
                        <p style="font-size:14px;color:#64748b">Москва, 123456</p>
                    </div>
                    
                    <div style="margin-bottom:20px">
                        <h3 style="color:#0f172a;margin-bottom:8px">💬 Социальные сети</h3>
                        <p>Telegram: @original_lux_shop</p>
                        <p>WhatsApp: +7 (999) 123-45-67</p>
                        <p>Instagram: @original_lux_shop</p>
                    </div>
                    
                    <div style="padding:16px;background:#f1f5f9;border-radius:8px;border-left:4px solid #527ea6">
                        <h4 style="margin:0 0 8px 0;color:#1e40af">💡 Быстрая связь</h4>
                        <p style="margin:0;font-size:14px">
                            Для быстрого ответа используйте Telegram. 
                            Среднее время ответа - 5-10 минут.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="search">
            <div class="search-input-wrapper">
                <input 
                    type="text" 
                    id="searchInput" 
                    placeholder="Поиск товаров..." 
                    autocomplete="off"
                />
                <button class="search-icon-btn" onclick="goToCatalog()" title="Искать">
                    🔍
                </button>
            </div>
            
            
            <!-- Результаты поиска -->
            <div class="search-results" id="searchResults">
                <!-- Результаты будут добавляться динамически -->
            </div>
        </div>

        <div class="tabs">
            <div id="tab-men" class="tab active" onclick="switchCatalog('men')">Мужской каталог</div>
            <div id="tab-women" class="tab" onclick="switchCatalog('women')">Женский каталог</div>
        </div>

        <section class="catalog">
            <div class="card" data-section="men" onclick="window.location.href='/category/clothing?gender=men'" style="cursor:pointer">
                <h4>Одежда</h4>
                <div class="img">
                    <img src="{{ asset('image/IMG_4589.JPG') }}" alt="Stone Island худи" style="width:100%;height:120px;object-fit:cover;border-radius:8px;max-width:100%;max-height:120px;">
                </div>
            </div>
            <div class="card" data-section="men" onclick="window.location.href='/category/shoes?gender=men'" style="cursor:pointer">
                <h4>Обувь</h4>
                <div class="img">
                    <img src="{{ asset('image/IMG_4590.JPG') }}" alt="Обувь" style="width:100%;height:120px;object-fit:cover;border-radius:8px;max-width:100%;max-height:120px;">
                </div>
            </div>
            <div class="card" data-section="men" onclick="window.location.href='/category/bags?gender=men'" style="cursor:pointer">
                <h4>Сумки</h4>
                <div class="img">
                    <img src="{{ asset('image/IMG_4591.JPG') }}" alt="Сумка Balenciaga" style="width:100%;height:120px;object-fit:cover;border-radius:8px;max-width:100%;max-height:120px;">
                </div>
            </div>
            <div class="card" data-section="men" onclick="window.location.href='/category/jewelry?gender=men'" style="cursor:pointer">
                <h4>Украшения</h4>
                <div class="img">
                    <img src="{{ asset('image/IMG_4592.JPG') }}" alt="Украшения" style="width:100%;height:120px;object-fit:cover;border-radius:8px;max-width:100%;max-height:120px;">
                </div>
            </div>
            <div class="card" data-section="men" onclick="window.location.href='/category/accessories?gender=men'" style="cursor:pointer">
                <h4>Аксессуары</h4>
                <div class="img">
                    <img src="{{ asset('image/IMG_4593.JPG') }}" alt="Ремень Gucci" style="width:100%;height:120px;object-fit:cover;border-radius:8px;max-width:100%;max-height:120px;">
                </div>
            </div>
            <div class="card" data-section="men" onclick="window.location.href='/category/watches?gender=men'" style="cursor:pointer">
                <h4>Часы</h4>
                <div class="img">
                    <img src="{{ asset('image/IMG_4594.JPG') }}" alt="Rolex Daytona" style="width:100%;height:120px;object-fit:cover;border-radius:8px;max-width:100%;max-height:120px;">
                </div>
            </div>

            <div class="card" data-section="women" onclick="window.location.href='/category/clothing?gender=women'" style="cursor:pointer">
                <h4>Одежда</h4>
                <div class="img">
                    <img src="{{ asset('image/IMG_4595.JPG') }}" alt="Женская одежда" style="width:100%;height:120px;object-fit:cover;border-radius:8px;max-width:100%;max-height:120px;">
                </div>
            </div>
            <div class="card" data-section="women" onclick="window.location.href='/category/shoes?gender=women'" style="cursor:pointer">
                <h4>Обувь</h4>
                <div class="img">
                    <img src="{{ asset('image/IMG_4596.JPG') }}" alt="Женская обувь" style="width:100%;height:120px;object-fit:cover;border-radius:8px;max-width:100%;max-height:120px;">
                </div>
            </div>
            <div class="card" data-section="women" onclick="window.location.href='/category/bags?gender=women'" style="cursor:pointer">
                <h4>Сумки</h4>
                <div class="img">
                    <img src="{{ asset('image/IMG_4597.JPG') }}" alt="Женские сумки" style="width:100%;height:120px;object-fit:cover;border-radius:8px;max-width:100%;max-height:120px;">
                </div>
            </div>
            <div class="card" data-section="women" onclick="window.location.href='/category/jewelry?gender=women'" style="cursor:pointer">
                <h4>Украшения</h4>
                <div class="img">
                    <img src="{{ asset('image/IMG_4598.JPG') }}" alt="Женские украшения" style="width:100%;height:120px;object-fit:cover;border-radius:8px;max-width:100%;max-height:120px;">
                </div>
            </div>
            <div class="card" data-section="women" onclick="window.location.href='/category/accessories?gender=women'" style="cursor:pointer">
                <h4>Аксессуары</h4>
                <div class="img">
                    <img src="{{ asset('image/IMG_4599.JPG') }}" alt="Женские аксессуары" style="width:100%;height:120px;object-fit:cover;border-radius:8px;max-width:100%;max-height:120px;">
                </div>
            </div>
            <div class="card" data-section="women" onclick="window.location.href='/category/watches?gender=women'" style="cursor:pointer">
                <h4>Часы</h4>
                <div class="img">
                    <img src="{{ asset('image/IMG_4600.JPG') }}" alt="Женские часы" style="width:100%;height:120px;object-fit:cover;border-radius:8px;max-width:100%;max-height:120px;">
                </div>
            </div>
        </section>
    </main>
    
    <section class="container">
        <div class="banner" style="background:rgb(220,215,242)">СКИДКИ ДО -20%</div>

        <div class="small-tiles">
            <div class="tile" style="background:rgb(211,220,231)">
                <h3>Отзывы</h3>
                <p>Перед заказом можно ознакомиться с реальными отзывами наших покупателей</p>
                <div style="margin-top:8px;color:#f59e0b">★★★★★</div>
            </div>
            <div class="tile" onclick="window.location.href='/promotions'" style="cursor:pointer;background:rgb(211,220,231)">
                <h3>Акции от OLS</h3>
                <p>Будьте в курсе новых акций нашего магазина и делайте покупки ещё выгоднее</p>
            </div>
        </div>

        <div class="promo" style="background:rgb(220,215,242);cursor:pointer" onclick="window.open('https://t.me/OLS_Managerr', '_blank')">
            <h3>КУПИТЬ ЕЩЁ ДЕШЕВЛЕ!!!</h3>
            <p>💬 Наш менеджер готов ответить на все ваши вопросы</p>
        </div>

        <div class="shop-layout">
            <aside class="filters" id="filters">
                <div class="filters-header">
                    <h3>Фильтры</h3>
                    <span class="reset" id="resetFilters">Сбросить</span>
                </div>

                <div class="filter-group open" data-group="category">
                    <div class="filter-head">Категории <span>▾</span></div>
                    <div class="filter-body">
                        <div class="filter-list" id="categoryList">
                            <div class="filter-item active" data-value="all">Все категории</div>
                            <div class="filter-item" data-value="Одежда">Одежда</div>
                            <div class="filter-item" data-value="Обувь">Обувь</div>
                            <div class="filter-item" data-value="Сумки">Сумки</div>
                            <div class="filter-item" data-value="Часы">Часы</div>
                            <div class="filter-item" data-value="Украшения">Украшения</div>
                            <div class="filter-item" data-value="Аксессуары">Аксессуары</div>
                        </div>
                    </div>
                </div>

                <div class="filter-group open" data-group="brands">
                    <div class="filter-head">Бренды <span>▾</span></div>
                    <div class="filter-body">
                        <div class="filter-list" id="brandList">
                            <div class="filter-item" data-value="Balenciaga">Balenciaga</div>
                            <div class="filter-item" data-value="Louis Vuitton">Louis Vuitton</div>
                            <div class="filter-item" data-value="Stone Island">Stone Island</div>
                            <div class="filter-item" data-value="Nike">Nike</div>
                            <div class="filter-item" data-value="Burberry">Burberry</div>
                            <div class="filter-item" data-value="Moncler">Moncler</div>
                            <div class="filter-item" data-value="Ralph Lauren">Ralph Lauren</div>
                        </div>
                    </div>
                </div>

                <div class="filter-group open" data-group="price">
                    <div class="filter-head">Диапазон цен: <span>▾</span></div>
                    <div class="filter-body">
                        <div class="price-row">
                            <input id="priceMin" type="number" placeholder="От: 50 €" min="0">
                            <input id="priceMax" type="number" placeholder="До: 100 €" min="0">
                        </div>
                    </div>
                </div>
            </aside>

            <div>
                <div class="section-title">ПОПУЛЯРНОЕ</div>
                <div class="goods" id="goods">
                    @if(isset($featuredProducts) && $featuredProducts->count() > 0)
                        @foreach($featuredProducts as $product)
                            <article class="good" data-category="{{ $product->category }}" data-brand="{{ $product->brand }}" data-subcat="{{ $product->subcat }}" data-price="{{ $product->price }}">
                        <form method="post" action="/favorites/add" style="position:absolute;top:8px;right:8px;z-index:10">
                            <?php echo csrf_field(); ?>
                                    <input type="hidden" name="title" value="{{ $product->title }}">
                                    <input type="hidden" name="price" value="{{ $product->price }}">
                                    <input type="hidden" name="image" value="{{ is_array($product->images) ? $product->images[0] : $product->image }}">
                            <button type="submit" class="favorite-btn" title="Добавить в избранное">♡</button>
                        </form>
                                <a href="/product/{{ $product->id }}" style="text-decoration:none;color:inherit;display:block">
                                    <img src="{{ is_array($product->images) ? $product->images[0] : $product->image }}" alt="{{ $product->title }}">
                            <div class="meta">
                                        <div>{{ $product->title }}</div>
                                        <div class="price">{{ $product->price }}€</div>
                                        
                                        <!-- Отображение пола -->
                                        @if($product->gender && is_array($product->gender) && count($product->gender) > 0)
                                            <div class="product-gender">
                                                @foreach($product->gender as $g)
                                                    <span class="gender-badge">{{ $g }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                        
                                        <!-- Отображение размеров -->
                                        @if($product->sizes && is_array($product->sizes) && count($product->sizes) > 0)
                                            <div class="product-sizes">
                                                <span class="sizes-label">Размеры:</span>
                                                @foreach(array_slice($product->sizes, 0, 3) as $size)
                                                    <span class="size-badge">{{ $size }}</span>
                                                @endforeach
                                                @if(count($product->sizes) > 3)
                                                    <span class="size-more">+{{ count($product->sizes) - 3 }}</span>
                                                @endif
                                            </div>
                                        @endif
                                        
                                        <!-- Отображение цветов -->
                                        @if($product->colors && is_array($product->colors) && count($product->colors) > 0)
                                            <div class="product-colors">
                                                <span class="colors-label">Цвета:</span>
                                                @foreach(array_slice($product->colors, 0, 4) as $color)
                                                    <span class="color-swatch" style="background-color: {{ $color }}" title="{{ $color }}"></span>
                                                @endforeach
                                                @if(count($product->colors) > 4)
                                                    <span class="color-more">+{{ count($product->colors) - 4 }}</span>
                                                @endif
                                            </div>
                                        @endif
                            </div>
                        </a>
                                <form method="post" action="/cart/add" style="margin-top:8px">
                            <?php echo csrf_field(); ?>
                                    <input type="hidden" name="title" value="{{ $product->title }}">
                                    <input type="hidden" name="price" value="{{ $product->price }}">
                                    <input type="hidden" name="image" value="{{ is_array($product->images) ? $product->images[0] : $product->image }}">
                            <button class="btn" type="submit">Добавить в корзину</button>
                        </form>
                    </article>
                        @endforeach
                    @else
                        <div style="text-align: center; padding: 40px; color: #666;">
                            <p>Популярные товары скоро появятся</p>
                            </div>
                    @endif
                </div>
                
                <!-- Кнопка "Перейти к другим" -->
                <div class="more-products-block">
                    <h3 class="more-products-title">Хотите увидеть больше товаров?</h3>
                    <p class="more-products-text">В нашем каталоге более 30 товаров в разных категориях</p>
                    <a href="/catalog" class="more-products-btn">
                        ПЕРЕЙТИ К ДРУГИМ ТОВАРАМ →
                    </a>
                </div>
                
            </div>
        </div>
    </section>
    
    <!-- JavaScript для функционального поиска -->
    <script>
        // Данные всех товаров для поиска
        const allProducts = [
            {
                id: '1',
                title: 'Кроссовки Nike Air Max 270 (белые)',
                price: 120,
                image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1200&auto=format&fit=crop',
                category: 'Обувь',
                brand: 'Nike',
                subcategory: 'Кроссовки'
            },
            {
                id: '2',
                title: 'Куртка Stone Island (чёрная)',
                price: 450,
                image: 'https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=1200&auto=format&fit=crop',
                category: 'Одежда',
                brand: 'Stone Island',
                subcategory: 'Куртки'
            },
            {
                id: '3',
                title: 'Сумка Balenciaga City (серая)',
                price: 1200,
                image: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop',
                category: 'Сумки',
                brand: 'Balenciaga',
                subcategory: 'Сумки'
            },
            {
                id: '4',
                title: 'Ремень Gucci (коричневый)',
                price: 280,
                image: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop',
                category: 'Аксессуары',
                brand: 'Gucci',
                subcategory: 'Ремни'
            },
            {
                id: '5',
                title: 'Кольцо Cartier Love (золотое)',
                price: 3200,
                image: 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop',
                category: 'Украшения',
                brand: 'Cartier',
                subcategory: 'Кольца'
            },
            {
                id: '6',
                title: 'Часы Rolex Daytona (золотые)',
                price: 15000,
                image: 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop',
                category: 'Часы',
                brand: 'Rolex',
                subcategory: 'Хронограф'
            },
            {
                id: '7',
                title: 'Кроссовки Adidas Ultraboost (синие)',
                price: 180,
                image: 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop',
                category: 'Обувь',
                brand: 'Adidas',
                subcategory: 'Кроссовки'
            },
            {
                id: '8',
                title: 'Футболка Balenciaga (белая)',
                price: 350,
                image: 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop',
                category: 'Одежда',
                brand: 'Balenciaga',
                subcategory: 'Футболки'
            },
            {
                id: '9',
                title: 'Кроссовки Puma RS-X (красные)',
                price: 95,
                image: 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1200&auto=format&fit=crop',
                category: 'Обувь',
                brand: 'Puma',
                subcategory: 'Кроссовки'
            },
            {
                id: '11',
                title: 'Футболка Nike Dri-FIT (синяя)',
                price: 45,
                image: 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop',
                category: 'Одежда',
                brand: 'Nike',
                subcategory: 'Футболки'
            },
            {
                id: '17',
                title: 'Рюкзак Gucci Marmont (чёрный)',
                price: 180,
                image: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=1200&auto=format&fit=crop',
                category: 'Сумки',
                brand: 'Gucci',
                subcategory: 'Рюкзак'
            },
            {
                id: '21',
                title: 'Часы Rolex Submariner (стальные)',
                price: 8500,
                image: 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop',
                category: 'Часы',
                brand: 'Rolex',
                subcategory: 'Механические'
            },
            {
                id: '22',
                title: 'Часы Omega Speedmaster (чёрные)',
                price: 4200,
                image: 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=1200&auto=format&fit=crop',
                category: 'Часы',
                brand: 'Omega',
                subcategory: 'Хронограф'
            },
            {
                id: '26',
                title: 'Кольцо Cartier Love (золотое)',
                price: 3200,
                image: 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=1200&auto=format&fit=crop',
                category: 'Украшения',
                brand: 'Cartier',
                subcategory: 'Кольца'
            },
            {
                id: '32',
                title: 'Очки Ray-Ban Aviator (золотые)',
                price: 180,
                image: 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w=1200&auto=format&fit=crop',
                category: 'Аксессуары',
                brand: 'Ray-Ban',
                subcategory: 'Очки'
            }
        ];

        let searchTimeout;

        // Инициализация поиска
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchResults = document.getElementById('searchResults');

            // Обработчик ввода в поиск
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    const query = this.value.trim().toLowerCase();
                    if (query.length >= 2) {
                        performSearch(query);
                        searchResults.style.display = 'block';
                    } else if (query.length === 0) {
                        // Показываем все товары только если поле пустое
                        showAllProducts();
                        searchResults.style.display = 'none';
                    }
                }, 300);
            });

            // Обработчик клика вне поиска
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.style.display = 'none';
                }
            });
        });

        // Функция поиска
        async function performSearch(query = '') {
            const searchInput = document.getElementById('searchInput');
            const searchResults = document.getElementById('searchResults');
            
            if (!query) {
                query = (searchInput.value || '').trim();
            }

            // Если меньше 2 символов — очищаем блок и выходим
            if (query.length < 2) {
                searchResults.innerHTML = '';
                searchResults.style.display = 'none';
                return;
            }

            // Показываем контейнер результатов
            searchResults.style.display = 'block';
            searchResults.innerHTML = '<div class="no-results">Идёт поиск…</div>';

            const params = new URLSearchParams();
            params.set('q', query);

            try {
                const resp = await fetch('/api/search-products?' + params.toString(), { headers: { 'Accept': 'application/json' } });
                if (!resp.ok) throw new Error('HTTP ' + resp.status);
                const data = await resp.json();
                const products = Array.isArray(data.products) ? data.products : [];
                displaySearchResults(products);
            } catch (e) {
                searchResults.innerHTML = '<div class="no-results">Ошибка поиска</div>';
            }
        }

        // Переход в каталог по текущему запросу/фильтрам
        function goToCatalog() {
            const searchInput = document.getElementById('searchInput');
            const q = (searchInput.value || '').trim();
            const params = new URLSearchParams();
            if (q) params.set('search', q);
            const url = '/catalog' + (params.toString() ? ('?' + params.toString()) : '');
            window.location.href = url;
        }

        // Отображение результатов поиска
        function displaySearchResults(products) {
            const searchResults = document.getElementById('searchResults');
            
            if (products.length === 0) {
                searchResults.innerHTML = `
                    <div class="no-results">
                        <div style="font-size: 24px; margin-bottom: 8px;">🔍</div>
                        <div>Товары не найдены</div>
                        <div style="font-size: 12px; color: #94a3b8; margin-top: 4px;">
                            Попробуйте изменить запрос или категорию
                        </div>
                    </div>
                `;
                return;
            }

            const resultsHTML = products.map(product => `
                <div class="search-result-item" onclick="goToProduct('${product.id}')">
                    <img src="${product.image}" alt="${product.title}" class="search-result-img">
                    <div class="search-result-info">
                        <div class="search-result-title">${product.title}</div>
                        <div class="search-result-category">${product.brand} • ${product.category}</div>
                    </div>
                    <div class="search-result-price">${product.price}€</div>
                </div>
            `).join('');

            searchResults.innerHTML = resultsHTML;
        }

        // Переход к товару
        function goToProduct(productId) {
            window.location.href = `/product/${productId}`;
        }

        // Показать все товары на главной странице
        function showAllProducts() {
            // На главной странице просто скрываем результаты поиска
            const searchResults = document.getElementById('searchResults');
            if (searchResults) {
                searchResults.style.display = 'none';
            }
        }

        // Поиск по Enter
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        // Обработчик клика вне модального окна FAQ
        document.getElementById('faqModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });

        // Функция переключения каталогов
        function switchCatalog(gender) {
            // Обновляем активную кнопку
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            document.getElementById('tab-' + gender).classList.add('active');
            
            // Показываем/скрываем соответствующие карточки
            document.querySelectorAll('.card').forEach(card => {
                if (card.dataset.section === gender) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Инициализация: показываем только мужские карточки по умолчанию
        document.addEventListener('DOMContentLoaded', function() {
            switchCatalog('men');
        });
    </script>

    <!-- Подключаем общие функции -->
    <script src="{{ asset('js/common-functions.js') }}"></script>

    <!-- FAQ Modal -->
    <div id="faqModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:1000">
        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:#fff;border-radius:12px;padding:24px;max-width:500px;width:90%;max-height:80vh;overflow-y:auto">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
                <h2 style="margin:0;color:#0f172a;font-size:24px;font-weight:700">Часто задаваемые вопросы</h2>
                <button onclick="document.getElementById('faqModal').style.display='none'; document.body.style.overflow='auto';" style="background:none;border:none;font-size:24px;cursor:pointer;color:#64748b">&times;</button>
            </div>
            <div style="color:#374151;line-height:1.6">
                <div style="margin-bottom:16px">
                    <h3 style="color:#0f172a;font-size:18px;margin-bottom:8px">Как оформить заказ?</h3>
                    <p>Выберите товар, добавьте в корзину и перейдите к оформлению заказа. Заполните контактные данные и выберите способ доставки.</p>
                </div>
                <div style="margin-bottom:16px">
                    <h3 style="color:#0f172a;font-size:18px;margin-bottom:8px">Какие способы оплаты доступны?</h3>
                    <p>Мы принимаем оплату наличными при получении, банковскими картами и электронными платежами.</p>
                </div>
                <div style="margin-bottom:16px">
                    <h3 style="color:#0f172a;font-size:18px;margin-bottom:8px">Сколько стоит доставка?</h3>
                    <p>Стоимость доставки зависит от региона и способа доставки. Подробную информацию вы найдете в разделе "Доставка".</p>
                </div>
                <div style="margin-bottom:16px">
                    <h3 style="color:#0f172a;font-size:18px;margin-bottom:8px">Можно ли вернуть товар?</h3>
                    <p>Да, вы можете вернуть товар в течение 14 дней с момента покупки при сохранении товарного вида и упаковки.</p>
                </div>
                <div style="margin-bottom:16px">
                    <h3 style="color:#0f172a;font-size:18px;margin-bottom:8px">Как связаться с поддержкой?</h3>
                    <p>Вы можете связаться с нами через Telegram канал или написать нам на почту. Мы отвечаем в течение 24 часов.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно авторизации -->
    <div id="auth-modal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:1000">
        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:#fff;border-radius:12px;padding:24px;max-width:400px;width:90%;max-height:80vh;overflow-y:auto">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
                <h2 style="margin:0;color:#0f172a;font-size:24px;font-weight:700">Вход в систему</h2>
                <button onclick="closeAuthModal()" style="background:none;border:none;font-size:24px;cursor:pointer;color:#64748b">&times;</button>
            </div>
            <div style="color:#374151;line-height:1.6;margin-bottom:20px">
                <p>Для добавления товаров в корзину необходимо войти в систему.</p>
            </div>
            <div style="display:flex;gap:12px;justify-content:center">
                <a href="/login" style="background:#527ea6;color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;transition:background 0.2s">Войти</a>
                <a href="/register" style="background:#f1f5f9;color:#475569;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;border:1px solid #cbd5e1;transition:background 0.2s">Регистрация</a>
            </div>
        </div>
    </div>
@endsection
