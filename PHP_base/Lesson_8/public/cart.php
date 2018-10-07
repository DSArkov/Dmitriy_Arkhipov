<?php
header("Content-type:text/html; charset=utf-8");

//Подключаем скрипты.
include __DIR__ . '/../config/main.php';
include CONFIG_DIR . 'db.php';
require_once ENGINE_DIR . 'autoload.php';


//Стартуем новую сессию либо возобновляем существующую.
session_start();

//Проверяем, существует ли массив users в сессии.
if(!$user_id = $_SESSION['users']) {
    //Если нет - вызывем функцию для переадресации страницы.
    redirect('login.php');
}

//Проверяем была ли нажата кнопка "Удалить".
if ($_REQUEST['delete']) {
    //Получаем id продукта с помощью POST запроса.
    $cart_id = $_POST['cart_id'];
    //Вызываем функцию для удаления товара из корзины.
    deleteFromCart($cart_id);
}

//Получаем данные о товрах, находящихся в массиве сессии.
$arrProd = getCartProd($_SESSION['cart']);

//Вызываем функцию для отрисовки шаблона.
render('cart', ['arrProd' => $arrProd, 'login' => $_SESSION['users']['login']]);