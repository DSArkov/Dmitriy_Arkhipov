<?php /** @var \app\models\Cart $arrProd */ ?>

<h1>Корзина</h1>
<!--Обходим в цикле массив с товарами корзины-->
<?php foreach ($arrProd as $product => $value): ?>
    <!--И если это не последний элемент массива-->
    <?php if ($product < count($arrProd) - 1): ?>
        <div class="item_wrapper">
            <!--Выводим номер строки и вставляем остальные данные в шаблон-->
            <span><?= $product + 1 ?></span>
            <div class="cart_img">
                <a href="product/card?id=<?= $value['id'] ?>">
                    <img width="150px" src="/img/min/<?= $value['url'] ?>" alt="cart_img">
                </a>
            </div>
            <div class="cart_item">
                <a href="product/card?id=<?= $value['id'] ?>">
                    <?= $value['title'] ?>
                </a>
                <div><?= $value['quantity'] ?> шт</div>
                <div class="cart_item__price"><?= $value['cost'] ?> руб</div>
                <!--$_SERVER['REQUEST_URI'] содержит имя скрипта, начиная от корневой директории
                виртуального хоста и параметры. Используем для переадресации страницы на саму себя-->
                <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                    <input type="hidden" name="cart_id" value="<?= $value['id'] ?>">
                    <input class="delete_btn" name="delete" type="submit" value="x">
                </form>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
<div class="total_count">
    <form action="#" method="post">
        <input class="add_order" name="add_order" type="submit" value="Оформить заказ">
    </form>
    <span>Итого: <?php echo (!$value['total']) ? 0 : $value['total'] ?> руб.</span>
</div>