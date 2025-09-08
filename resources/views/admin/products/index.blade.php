@extends('layouts.app')

@section('title', 'Управление товарами | Админ-панель')

@section('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, 'Helvetica Neue', Arial, "Noto Sans", sans-serif;
        background: #f8fafc;
        color: #1a202c;
    }

        .admin-header {
            background: #2d3748;
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .admin-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .admin-header p {
            color: #a0aec0;
            margin-top: 0.25rem;
        }

        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .admin-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .add-product-btn {
            background: #4299e1;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.2s;
        }

        .add-product-btn:hover {
            background: #3182ce;
        }

        .search-box {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .search-input {
            padding: 0.5rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 0.875rem;
            width: 300px;
        }

        .search-btn {
            background: #48bb78;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-info {
            padding: 1rem;
        }

        .product-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #2d3748;
        }

        .product-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .product-price {
            font-size: 1.125rem;
            font-weight: 600;
            color: #38a169;
        }

        .product-category {
            font-size: 0.875rem;
            color: #718096;
            background: #f7fafc;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            font-size: 0.75rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            transition: all 0.2s;
        }

        .btn-edit {
            background: #4299e1;
            color: white;
        }

        .btn-edit:hover {
            background: #3182ce;
        }

        .btn-delete {
            background: #f56565;
            color: white;
        }

        .btn-delete:hover {
            background: #e53e3e;
        }

        .btn-toggle {
            background: #48bb78;
            color: white;
        }

        .btn-toggle:hover {
            background: #38a169;
        }

        .btn-inactive {
            background: #a0aec0;
            color: white;
        }

        .btn-inactive:hover {
            background: #718096;
        }

        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-active {
            background: #c6f6d5;
            color: #22543d;
        }

        .status-inactive {
            background: #fed7d7;
            color: #742a2a;
        }

        .status-featured {
            background: #fef5e7;
            color: #744210;
            margin-left: 0.5rem;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .pagination a {
            padding: 0.5rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            text-decoration: none;
            color: #4a5568;
            transition: all 0.2s;
        }

        .pagination a:hover {
            background: #f7fafc;
        }

        .pagination .active {
            background: #4299e1;
            color: white;
            border-color: #4299e1;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .empty-state h3 {
            color: #4a5568;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #718096;
            margin-bottom: 1.5rem;
        }

        .back-btn {
            background: #718096;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .back-btn:hover {
            background: #4a5568;
        }

        @media (max-width: 768px) {
            .admin-container {
                padding: 1rem;
            }

            .admin-actions {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .search-box {
                flex-direction: column;
            }

            .search-input {
                width: 100%;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
<div class="admin-container">
        <a href="{{ route('admin.dashboard') }}" class="back-btn">← Назад к панели</a>

        <div class="admin-actions">
            <a href="{{ route('admin.products.create') }}" class="add-product-btn">
                ➕ Добавить товар
            </a>
            
            <div class="search-box">
                <form method="GET" action="{{ route('admin.products.index') }}">
                    <input type="text" name="search" placeholder="Поиск товаров..." 
                           value="{{ request('search') }}" class="search-input">
                    <button type="submit" class="search-btn">🔍 Поиск</button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div style="background: #c6f6d5; color: #22543d; padding: 1rem; border-radius: 6px; margin-bottom: 1rem;">
                {{ session('success') }}
            </div>
        @endif

        @if($products->count() > 0)
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        <img src="{{ $product->images[0] ?? 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?q=80&w=1200&auto=format&fit=crop' }}" 
                             alt="{{ $product->title }}" class="product-image">
                        
                        <div class="product-info">
                            <h3 class="product-title">{{ $product->title }}</h3>
                            
                            <div class="product-details">
                                <span class="product-price">{{ $product->price }}€</span>
                                <span class="product-category">{{ $product->category }}</span>
                            </div>

                            <div style="margin-bottom: 1rem;">
                                <span class="status-badge {{ $product->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $product->is_active ? 'Активен' : 'Неактивен' }}
                                </span>
                                @if($product->featured)
                                    <span class="status-badge status-featured">
                                        ⭐ Популярный
                                    </span>
                                @endif
                            </div>

                            <div class="product-actions">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-edit">
                                    ✏️ Редактировать
                                </a>
                                
                                <form method="POST" action="{{ route('admin.products.update', $product->id) }}" 
                                      style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="is_active" value="{{ $product->is_active ? 0 : 1 }}">
                                    <button type="submit" class="btn {{ $product->is_active ? 'btn-inactive' : 'btn-toggle' }}">
                                        {{ $product->is_active ? '❌ Скрыть' : '✅ Показать' }}
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" 
                                      style="display: inline;" onsubmit="return confirm('Вы уверены, что хотите удалить этот товар?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">
                                        🗑️ Удалить
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($products->hasPages())
                <div class="pagination">
                    {{ $products->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <h3>Товары не найдены</h3>
                <p>Пока нет товаров в каталоге. Добавьте первый товар!</p>
                <a href="{{ route('admin.products.create') }}" class="add-product-btn">
                    ➕ Добавить товар
                </a>
            </div>
        @endif
    </div>
@endsection

