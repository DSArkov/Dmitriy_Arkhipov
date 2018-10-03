<?php

//Подключаем скрипты.
include __DIR__ . '/../config/main.php';
include CONFIG_DIR . 'bd.php';
include ENGINE_DIR . 'bd.php';
include ENGINE_DIR . 'render.php';
include ENGINE_DIR . 'products.php';


//Формируем запрос для получения всех данных таблицы из БД.
$products = getAllProducts();
//Вызываем функцию для отрисовки шаблона.
render('catalogue', ['products' => $products]);