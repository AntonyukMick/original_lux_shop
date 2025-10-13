<style>
    /* Общие стили для админ-панели */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    body { 
        font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, 'Helvetica Neue', Arial, "Noto Sans", sans-serif; 
        background: #f8fafc; 
        color: #0f172a; 
        line-height: 1.6;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 16px;
    }
    
    .main {
        padding: 32px 0;
    }
    
    .page-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .page-title {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 16px;
        color: #0f172a;
    }
    
    .page-subtitle {
        font-size: 16px;
        color: #64748b;
    }
    
    .admin-panel {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 32px;
        margin-bottom: 24px;
    }
    
    .section-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 24px;
        color: #0f172a;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .form-group.full-width {
        grid-column: 1 / -1;
    }
    
    .form-label {
        font-weight: 600;
        color: #374151;
        font-size: 14px;
    }
    
    .form-input, .form-select, .form-textarea {
        padding: 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 16px;
        transition: border-color 0.2s;
    }
    
    .form-input:focus, .form-select:focus, .form-textarea:focus {
        outline: none;
        border-color: #527ea6;
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: #527ea6;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .btn:hover {
        background: #3d5a7a;
        transform: translateY(-1px);
    }
    
    .btn-secondary {
        background: #64748b;
    }
    
    .btn-secondary:hover {
        background: #475569;
    }
    
    .btn-danger {
        background: #dc2626;
    }
    
    .btn-danger:hover {
        background: #b91c1c;
    }
    
    /* Адаптивные стили */
    @media (max-width: 768px) {
        .container {
            padding: 0 12px;
        }
        
        .main {
            padding: 20px 0;
        }
        
        .page-title {
            font-size: 24px;
        }
        
        .page-subtitle {
            font-size: 14px;
        }
        
        .admin-panel {
            padding: 20px;
        }
        
        .section-title {
            font-size: 20px;
            margin-bottom: 16px;
        }
        
        .form-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        
        .form-input, .form-select, .form-textarea {
            padding: 10px;
            font-size: 16px; /* Предотвращает зум на iOS */
        }
        
        .form-textarea {
            min-height: 80px;
        }
        
        .btn {
            padding: 12px 20px;
            font-size: 14px;
        }
    }
    
    @media (max-width: 480px) {
        .container {
            padding: 0 8px;
        }
        
        .main {
            padding: 16px 0;
        }
        
        .page-title {
            font-size: 20px;
        }
        
        .admin-panel {
            padding: 16px;
        }
        
        .section-title {
            font-size: 18px;
        }
        
        .form-grid {
            gap: 12px;
        }
        
        .form-input, .form-select, .form-textarea {
            padding: 8px;
            font-size: 16px;
        }
        
        .form-textarea {
            min-height: 60px;
        }
        
        .btn {
            padding: 10px 16px;
            font-size: 13px;
        }
    }
</style>
