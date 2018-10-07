<?php
header("Content-type:text/html; charset:utf-8");

//Подключаем скрипты.
include __DIR__ . '/../config/main.php';
include CONFIG_DIR . 'db.php';
require_once ENGINE_DIR . 'autoload.php';


//Стартуем новую сессию либо возобновляем существующую.
session_start();

//Проверяем была ли нажата кнопка "Оформить заказ".
if ($_REQUEST['add_order']) {
    //Если да, то вызываем функцию для добавления информации о заказе в БД.
    addOrder();
}

//Получаем информацию о заказах.
$arr_orders = getOrder();

//Вызываем функцию для отрисовки шаблона, передавая необходимые параметры.
render('orders', ['arr_order' => $arr_orders]);