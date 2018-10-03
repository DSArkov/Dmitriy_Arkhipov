<?php

//Подключаем скрипты.
include __DIR__ . '/../config/main.php';
include CONFIG_DIR . 'bd.php';
include ENGINE_DIR . 'bd.php';
include ENGINE_DIR . 'render.php';
include ENGINE_DIR . 'products.php';

//Стартуем новую сессию либо возобновляем существующую.
session_start();

//Формируем запрос для получения всех данных таблицы из БД.
$products = getAllProducts();

//Вызываем функцию для отрисовки шаблона.
render('cart', ['$products' => $products]);