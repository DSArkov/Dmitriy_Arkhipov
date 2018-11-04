<?php /** @var \app\models\Product $model */?>

<h1>Каталог товаров</h1>
<div class="wrapper">
    <!--Перебираем массив с данными о товарах и вставляем их в шаблон-->
    <?php foreach ($model as $product):?>
        <div class="item">
            <a href="product/card?id=<?=$product -> id?>">
                <img src="img/min/<?=$product -> url?>" alt="img">
                <?= $product -> title ?>
            </a>
            <span><?=$product -> price?> руб</span>
            <!--$_SERVER['REQUEST_URI'] содержит имя скрипта, начиная от корневой директории
                   виртуального хоста и параметры. Используем для переадресации страницы на саму себя-->
            <form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
                <input type="hidden" name="id" value="<?=$product -> id?>">
                <input class="buy_button" name="submit" type="submit" value="В корзину">
            </form>
        </div>
    <?php endforeach;?>
</div>
