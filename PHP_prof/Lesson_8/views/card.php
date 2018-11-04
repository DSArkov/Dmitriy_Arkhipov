<?php /** @var \app\models\Product $model */?>

<h1><?=$model -> title?></h1>
<div class="single_item">

    <div class="single_item__left">
        <img src="/img/<?=$model -> url?>">
    </div>

    <div class="single_item__right">
        <div class="single_item__right__buy_price">
            <span><?=$model -> price?> руб</span>
            <!--$_SERVER['REQUEST_URI'] содержит имя скрипта, начиная от корневой директории
            виртуального хоста и параметры. Используем для переадресации страницы на саму себя-->
            <form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
                <input type="hidden" name="id" value="<?=$model -> id?>">
                <input class="single_item__right__buy_price__buy_button" name="submit" type="submit" value="В корзину">
            </form>
        </div>
        <div class="single_item__right__brand">
            <span>Производитель:</span> <?=$model -> brand?>.
        </div>
        <div class="single_item__right__description">
            <span>Описание:</span> <?=$model -> description?>
        </div>
    </div>

</div>
