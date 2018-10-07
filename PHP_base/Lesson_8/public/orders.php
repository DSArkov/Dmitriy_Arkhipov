<?php
header("Content-type:text/html; charset:utf-8");

//Подключаем скрипты.
include __DIR__ . '/../config/main.php';
include CONFIG_DIR . 'db.php';
require_once ENGINE_DIR . 'autoload.php';


//Стартуем новую сессию либо возобновляем существующую.
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_order = $_POST['id_order'];
    deleteOrder($id_order);
}

//Проверяем была ли нажата кнопка "Оформить заказ".
if ($_REQUEST['add_order']) {
    //Если да, то вызываем функцию для добавления информации о заказе в БД.
    addOrder();
}

//Получаем информацию о заказах из MySQL.
$arr_orders = getOrder();

//Вызываем функцию для отрисовки шаблона, передавая необходимые параметры.
render('orders', ['arr_order' => $arr_orders, 'login' => $_SESSION['users']['login']]);