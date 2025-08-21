<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход | ORIGINAL | LUX SHOP</title>
    <style>
        body{margin:0;font-family:system-ui,Segoe UI,Inter,Arial;background:#f1f5f9;color:#0f172a}
        .wrap{max-width:380px;margin:10vh auto;background:#fff;border:1px solid #cbd5e1;border-radius:12px;padding:20px}
        h1{margin:0 0 12px 0;font-size:20px}
        .row{display:flex;flex-direction:column;gap:6px;margin-bottom:12px}
        input{height:40px;border:1px solid #cbd5e1;border-radius:8px;padding:0 12px}
        .btn{height:40px;border:none;border-radius:8px;background:#527ea6;color:#fff;font-weight:700;cursor:pointer}
        .error{color:#b91c1c;font-size:12px}
        a{color:#2563eb;text-decoration:none}
    </style>
</head>
<body>
    <div class="wrap">
        <h1>Вход</h1>
        <form method="post" action="/login">
            <?php echo csrf_field(); ?>
            <div class="row">
                <label>Логин</label>
                <input name="username" value="<?php echo e(old('username')); ?>" required>
                <?php if($errors->first('username')): ?><div class="error"><?php echo e($errors->first('username')); ?></div><?php endif; ?>
            </div>
            <div class="row">
                <label>Пароль</label>
                <input type="password" name="password" required>
            </div>
            <button class="btn" type="submit">Войти</button>
        </form>
        <div style="margin-top:10px;font-size:12px;color:#475569">admin/admin — права администратора; user/user — макетный пользователь.</div>
        <div style="margin-top:12px"><a href="/">← На главную</a></div>
    </div>
</body>
</html>


