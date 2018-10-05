<?php
header("Content-type:text/html; charset=utf-8");

//Подключаем скрипты.
include __DIR__ . '/../config/main.php';
include CONFIG_DIR . 'bd.php';
include ENGINE_DIR . 'bd.php';
include ENGINE_DIR . 'render.php';
include ENGINE_DIR . 'products.php';
include ENGINE_DIR . 'cart.php';


//Стартуем новую сессию либо возобновляем существующую.
session_start();

//Проверяем была ли нажата кнопка "В корзину".
if ($_REQUEST['submit']) {
    //Получаем id продукта с помощью POST запроса.
    $id = $_POST['id'];
    //Добавляем его в суперглобальный массив $_SESSION и присваиваем количество.
    addToCart($id);
}

//Формируем запрос для получения всех данных таблицы из БД.
$products = getAllProducts();

//Вызываем функцию для отрисовки шаблона, передавая необходимые параметры.
render('catalogue', ['products' => $products, 'login' => $_SESSION['users']['login']]);