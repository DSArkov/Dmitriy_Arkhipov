<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catalogue</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="../public/css/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="cart cart_catalogue">

                <!--Проверяем залогинен пользователь или нет-->
                <?php echo (!$user_id = $_SESSION['users']) ?
                        //Если нет, показываем ссылку на страницу авторизации.
                        "<a class='enter' href='../public/login.php'>Войти</a>" :
                    //Если да - приветствуем!
                    "<div class='enter'>Привет, {$login}!<br><a class='account' href='../public/orders.php'>Заказы</a> | 
                                                            <a class='exit' href='../public/exit.php'>Выйти</a></div>" ?>

                <a href="cart.php"><img src="../public/img/main/cart.png" alt="cart"></a>
            </div>
        </div>
    </header>

    <div class="container">
        <h1>Каталог товаров</h1>
        <div class="wrapper">
            <!--Перебираем массив с данными о товарах и вставляем их в шаблон-->
            <?php foreach ($products as $product): ?>
                <div class="item">
                    <a href="../public/product.php?id=<?= $product['id'] ?>">
                        <img src="../public/img/min/<?= $product['url'] ?>" alt="img">
                        <?= $product['title'] ?>
                    </a>
                    <span><?= $product['price'] ?> руб</span>
                    <!--$_SERVER['REQUEST_URI'] содержит имя скрипта, начиная от корневой директории
                    виртуального хоста и параметры. Используем для переадресации страницы на саму себя-->
                    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                        <input class="buy_button" name="submit" type="submit" value="В корзину">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
