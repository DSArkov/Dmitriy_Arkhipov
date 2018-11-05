<?php /** @var \app\models\Product $model */ ?>

<h1>Каталог товаров</h1>
<div class="wrapper">
    <!--Перебираем массив с данными о товарах и вставляем их в шаблон-->
    <?php foreach ($model as $product): ?>
        <div class="item">
            <a href="/product/card?id=<?= $product->id ?>">
                <img src="img/min/<?= $product->url ?>" alt="img">
                <?= $product->title ?>
            </a>
            <span><?= $product->price ?> руб</span>
            <!--$_SERVER['REQUEST_URI'] содержит имя скрипта, начиная от корневой директории
                   виртуального хоста и параметры. Используем для переадресации страницы на саму себя-->
            <form action="/product" method="post">
                <input type="hidden" name="id" value="<?= $product->id ?>">
                <input type="submit" class="buy_button" name="submit" value="В корзину">
            </form>
        </div>
    <?php endforeach; ?>
</div>
