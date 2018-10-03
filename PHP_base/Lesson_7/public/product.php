<?php

//Подключаем скрипты.
include __DIR__ . '/../config/main.php';
include CONFIG_DIR . 'bd.php';
include ENGINE_DIR . 'bd.php';
include ENGINE_DIR . 'render.php';
include ENGINE_DIR . 'products.php';


//Стартуем новую сессию либо возобновляем существующую.
session_start();
//Получаем id GET запросом.
$id = $_GET['id'];
//Формируем SQL-запрос для получения данных контретного товара из таблицы.
$product = getOneProductById($id);
//Отрисовываем шаблон.
render('single_page', ['product' => $product]);