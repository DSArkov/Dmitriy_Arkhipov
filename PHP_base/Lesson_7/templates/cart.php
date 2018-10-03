<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <link href="../public/css/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="cart">
                <a href="cart.php"><img src="../public/img/main/cart.png" alt="cart"></a>
            </div>
        </div>
    </header>

    <div class="container">
        <h1>Корзина</h1>

        <?php foreach ($products as $product): ?>
        <div class="cart_item">
            <form action="" method="post">
                <input type="hidden" name="cart_id" value="<?= $product['product_id'] ?>">
                <input type="submit" value="Удалить">
            </form>
        </div>
        <?php endforeach; ?>
        Всего: <?= $cost ?> руб.
    </div>
</body>
</html>