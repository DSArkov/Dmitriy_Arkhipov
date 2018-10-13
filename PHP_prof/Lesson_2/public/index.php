<?php

//Подключаем скрипт.
include $_SERVER['DOCUMENT_ROOT'] . '/services/Autoloader.php';
//Задаём псевдоним для "app\models\Product".
use app\models\Product as Product;
//Задаём псевдоним для "app\services\Db".
use app\services\Db as Db;

//Регистрируем автозагрузчик объекта "Autoloader", метод "loadClass".
spl_autoload_register([new Autoloader(), 'loadClass']);

//Создаём экземпляр класса "Db".
$db = new Db();
//Создаём экземпляр класса "Product".
$product = new Product($db);