<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Избранное | ORIGINAL | LUX SHOP</title>
    <style>
        body{margin:0;font-family:Inter,system-ui,Segoe UI,Arial;background:#f1f5f9;color:#0f172a}
        .container{max-width:900px;margin:0 auto;padding:12px}
        .panel{background:#fff;border:1px solid #cbd5e1;border-radius:10px;padding:12px}
        .row{display:grid;grid-template-columns:1fr 120px 120px 40px;gap:10px;align-items:center;border-bottom:1px solid #e2e8f0;padding:8px 0}
        .row:last-child{border-bottom:none}
        .thumb{width:70px;height:70px;border-radius:8px;background:#e5e7eb;object-fit:cover;margin-right:10px}
        .title{font-weight:600}
        .price{font-weight:700}
        .btn{height:34px;padding:0 10px;border-radius:8px;border:1px solid #cbd5e1;background:#fff;cursor:pointer}
        .btn.primary{background:#527ea6;color:#fff;border-color:#527ea6}
        .btn.primary:hover{background:#3b5a7a}
        .nav{display:flex;gap:8px;margin-bottom:10px}
        .link{display:inline-block;padding:6px 10px;border:1px solid #cbd5e1;border-radius:8px;background:#fff;text-decoration:none;color:inherit}
        .empty{text-align:center;padding:40px 20px;color:#64748b}
        .empty-icon{font-size:48px;margin-bottom:16px}
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a class="link" href="/">← На главную</a>
        </div>
        <div class="panel">
            <h2 style="margin:0 0 8px 0">Избранное</h2>
            <?php if(empty($favorites)): ?>
            <div class="empty">
                <div class="empty-icon">❤️</div>
                <h3 style="margin:0 0 8px 0;color:#0f172a">Избранное пусто</h3>
                <p style="margin:0">Добавляйте товары в избранное, нажимая на сердечко ❤️ рядом с товаром</p>
            </div>
            <?php else: ?>
            <?php foreach($favorites as $key=>$item): ?>
            <div class="row">
                <div style="display:flex;align-items:center">
                    <?php if($item['image']): ?>
                        <img class="thumb" src="<?php echo e($item['image']); ?>" alt="">
                    <?php else: ?>
                        <div class="thumb"></div>
                    <?php endif; ?>
                    <div class="title"><?php echo e($item['title']); ?></div>
                </div>
                <div class="price"><?php echo e((int)$item['price']); ?>€</div>
                <form method="post" action="/cart/add" style="margin:0">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="title" value="<?php echo e($item['title']); ?>">
                    <input type="hidden" name="price" value="<?php echo e($item['price']); ?>">
                    <input type="hidden" name="image" value="<?php echo e($item['image']); ?>">
                    <button class="btn primary" type="submit">В корзину</button>
                </form>
                <form method="post" action="/favorites/remove">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="key" value="<?php echo e($key); ?>">
                    <button class="btn" title="Удалить из избранного">✕</button>
                </form>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
