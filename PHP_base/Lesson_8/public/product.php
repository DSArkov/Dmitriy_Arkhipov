<?php
header("Content-type:text/html; charset=utf-8");

//Подключаем скрипты.
include __DIR__ . '/../config/main.php';
include CONFIG_DIR . 'db.php';
require_once ENGINE_DIR . 'autoload.php';


//Стартуем новую сессию либо возобновляем существующую.
session_start();

//Проверяем была ли нажата кнопка "В корзину".
if ($_REQUEST['submit']) {
    //Получаем id продукта с помощью POST запроса.
    $id = $_POST['id'];
    //Добавляем его в суперглобальный массив $_SESSION и присваиваем количество.
    addToCart($id);
}

//Получаем id GET запросом.
$id = $_GET['id'];
//Формируем SQL-запрос для получения данных контретного товара из таблицы.
$product = getOneProductById($id);
//Отрисовываем шаблон, передавая необходимые параметры.
render('single_page', ['product' => $product, 'login' => $_SESSION['users']['login']]);