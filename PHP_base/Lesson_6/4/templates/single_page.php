<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $product['title'] ?></title>
    <link href="../public/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1><?= $product['title'] ?></h1>
        <div class="single_item">

            <div class="single_item__left">
                <img src="../public/img/<?= $product['url'] ?>">
            </div>

            <div class="single_item__right">
                <div class="single_item__right__buy_price">
                    <span><?= $product['price'] ?> руб</span>
                </div>

                <div class="single_item__right__brand">
                    <span>Производитель:</span> <?= $product['brand'] ?>.
                </div>

                <div class="single_item__right__description">
                    <span>Описание:</span> <?= $product['description'] ?>
                </div>
            </div>

        </div>
    </div>
</body>
</html>