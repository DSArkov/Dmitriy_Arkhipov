<?php

//Подключаем скрипты.
include __DIR__ . '/../config/main.php';
include CONFIG_DIR . 'bd.php';
include ENGINE_DIR . 'bd.php';
include ENGINE_DIR . 'render.php';
include ENGINE_DIR . 'products.php';
include ENGINE_DIR . 'cart.php';

//Стартуем новую сессию либо возобновляем существующую.
session_start();

//Проверяем была ли нажата кнопка "Удалить".
if ($_REQUEST['delete']) {
    //Получаем id продукта с помощью POST запроса.
    $cart_id = $_POST['cart_id'];
    //Добавляем его в суперглобальный массив $_SESSION и присваиваем количество.
    deleteFromCart($cart_id);
}

//Получаем данные о товрах, находящихся в массиве сессии.
$arrProd = getCartProd($_SESSION['cart']);

//Вызываем функцию для отрисовки шаблона.
render('cart', ['arrProd' => $arrProd]);