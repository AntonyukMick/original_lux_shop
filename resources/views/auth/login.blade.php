@extends('layouts.app')

@section('title', 'Вход / Регистрация')

@section('styles')
<style>
    body{margin:0;font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,'Helvetica Neue',Arial,"Noto Sans",sans-serif;background:#f1f5f9;color:#0f172a}
    .wrap{max-width:420px;margin:5vh auto;background:#fff;border:1px solid #cbd5e1;border-radius:12px;padding:24px}
    h1{margin:0 0 20px 0;font-size:24px;text-align:center}
    .form-tabs{display:flex;margin-bottom:20px;border-bottom:1px solid #e2e8f0}
    .tab-btn{flex:1;padding:12px;border:none;background:none;cursor:pointer;font-weight:500;color:#64748b;border-bottom:2px solid transparent;transition:all 0.2s}
    .tab-btn.active{color:#527ea6;border-bottom-color:#527ea6}
    .tab-btn:hover{color:#527ea6}
    .form-content{display:none}
    .form-content.active{display:block}
    .row{display:flex;flex-direction:column;gap:6px;margin-bottom:16px}
    .row label{font-weight:500;color:#374151}
    input{height:44px;border:1px solid #cbd5e1;border-radius:8px;padding:0 12px;font-size:14px;transition:border-color 0.2s}
    input:focus{outline:none;border-color:#527ea6;box-shadow:0 0 0 3px rgba(82,126,166,0.1)}
    .btn{height:44px;border:none;border-radius:8px;background:#527ea6;color:#fff;font-weight:600;cursor:pointer;font-size:14px;transition:background 0.2s}
    .btn:hover{background:#3b5a7a}
    .btn-secondary{background:#f1f5f9;color:#475569;border:1px solid #cbd5e1}
    .btn-secondary:hover{background:#e2e8f0}
    .error{color:#dc2626;font-size:12px;margin-top:4px}
    .success{color:#059669;font-size:12px;margin-top:4px}
    a{color:#2563eb;text-decoration:none}
    .help-text{font-size:12px;color:#64748b;margin-top:8px;text-align:center}
    .back-link{margin-top:16px;text-align:center}
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 16px;
    }
</style>
@endsection

@section('content')
<div class="wrap">
    <h1>Вход / Регистрация</h1>
    
    <!-- Табы для переключения между входом и регистрацией -->
    <div class="form-tabs">
        <button type="button" class="tab-btn active" onclick="showTab('login')">Вход</button>
        <button type="button" class="tab-btn" onclick="showTab('register')">Регистрация</button>
    </div>

    <!-- Форма входа -->
    <div id="login-form" class="form-content active">
        <form method="post" action="/login">
            <?php echo csrf_field(); ?>
            <div class="row">
                <label>Telegram тег</label>
                <input name="telegram_tag" value="<?php echo e(old('telegram_tag')); ?>" required placeholder="@username">
                <?php if($errors->first('telegram_tag')): ?><div class="error"><?php echo e($errors->first('telegram_tag')); ?></div><?php endif; ?>
            </div>
            <div class="row">
                <label>Пароль</label>
                <input type="password" name="password" required placeholder="Введите пароль">
                <?php if($errors->first('password')): ?><div class="error"><?php echo e($errors->first('password')); ?></div><?php endif; ?>
            </div>
            <button class="btn" type="submit">Войти</button>
        </form>
        <div class="help-text">
            Используйте ваш Telegram тег для входа
        </div>
    </div>

    <!-- Форма регистрации -->
    <div id="register-form" class="form-content">
        <form method="post" action="/register">
            <?php echo csrf_field(); ?>
            <div class="row">
                <label>Имя</label>
                <input name="name" value="<?php echo e(old('name')); ?>" required placeholder="Ваше имя">
                <?php if($errors->first('name')): ?><div class="error"><?php echo e($errors->first('name')); ?></div><?php endif; ?>
            </div>
            <div class="row">
                <label>Telegram тег</label>
                <input name="telegram_tag" value="<?php echo e(old('telegram_tag')); ?>" required placeholder="@username">
                <?php if($errors->first('telegram_tag')): ?><div class="error"><?php echo e($errors->first('telegram_tag')); ?></div><?php endif; ?>
            </div>
            <div class="row">
                <label>Пароль</label>
                <input type="password" name="password" required placeholder="Минимум 6 символов">
                <?php if($errors->first('password')): ?><div class="error"><?php echo e($errors->first('password')); ?></div><?php endif; ?>
            </div>
            <div class="row">
                <label>Подтверждение пароля</label>
                <input type="password" name="password_confirmation" required placeholder="Повторите пароль">
                <?php if($errors->first('password_confirmation')): ?><div class="error"><?php echo e($errors->first('password_confirmation')); ?></div><?php endif; ?>
            </div>
            <button class="btn" type="submit">Зарегистрироваться</button>
        </form>
        <div class="help-text">
            После регистрации вы автоматически войдете в систему
        </div>
    </div>

    <div class="back-link">
        <a href="/">← На главную</a>
    </div>
</div>

<script>
function showTab(tabName) {
    // Скрываем все формы
    document.querySelectorAll('.form-content').forEach(form => {
        form.classList.remove('active');
    });
    
    // Убираем активный класс с всех кнопок
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Показываем нужную форму
    document.getElementById(tabName + '-form').classList.add('active');
    
    // Активируем нужную кнопку
    event.target.classList.add('active');
}

// Валидация формы регистрации
document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('register-form');
    if (registerForm) {
        const form = registerForm.querySelector('form');
        const password = form.querySelector('input[name="password"]');
        const passwordConfirmation = form.querySelector('input[name="password_confirmation"]');
        const telegramTag = form.querySelector('input[name="telegram_tag"]');
        
        // Проверка совпадения паролей в реальном времени
        function checkPasswordMatch() {
            if (password.value && passwordConfirmation.value) {
                if (password.value !== passwordConfirmation.value) {
                    passwordConfirmation.setCustomValidity('Пароли не совпадают');
                    passwordConfirmation.style.borderColor = '#dc2626';
                } else {
                    passwordConfirmation.setCustomValidity('');
                    passwordConfirmation.style.borderColor = '#cbd5e1';
                }
            }
        }
        
        password.addEventListener('input', checkPasswordMatch);
        passwordConfirmation.addEventListener('input', checkPasswordMatch);
        
        // Проверка telegram тега
        telegramTag.addEventListener('input', function() {
            let value = this.value;
            // Автоматически добавляем @ если пользователь забыл
            if (value && !value.startsWith('@')) {
                this.value = '@' + value;
            }
        });
        
        telegramTag.addEventListener('blur', function() {
            const tagValue = this.value;
            if (tagValue) {
                // Проверяем формат telegram тега: @username (только латиница, цифры и подчеркивание)
                if (!tagValue.match(/^@[a-zA-Z0-9_]{5,32}$/)) {
                    this.setCustomValidity('Некорректный формат Telegram тега. Используйте @username (5-32 символа)');
                    this.style.borderColor = '#dc2626';
                } else {
                    this.setCustomValidity('');
                    this.style.borderColor = '#cbd5e1';
                }
            }
        });
        
        // Валидация формы перед отправкой
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Проверяем все обязательные поля
            const requiredFields = form.querySelectorAll('input[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = '#dc2626';
                    isValid = false;
                } else {
                    field.style.borderColor = '#cbd5e1';
                }
            });
            
            // Проверяем совпадение паролей
            if (password.value !== passwordConfirmation.value) {
                passwordConfirmation.style.borderColor = '#dc2626';
                isValid = false;
            }
            
            // Проверяем формат telegram тега
            if (telegramTag.value && !telegramTag.value.match(/^@[a-zA-Z0-9_]{5,32}$/)) {
                telegramTag.style.borderColor = '#dc2626';
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Пожалуйста, исправьте ошибки в форме');
            }
        });
    }
});
</script>
@endsection
