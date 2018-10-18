<?php

//Подключаем скрипты.
include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
include ROOT_DIR . 'services/Autoloader.php';

//Задаём псевдоним для "app\services\Db".
use app\services\Autoloader as Autoloader;
//Задаём псевдоним для "app\models\Product".
use app\models\Product as Product;

//Регистрируем автозагрузчик объекта "Autoloader", метод "loadClass".
spl_autoload_register([new Autoloader(), 'loadClass']);

//Создаём экземпляр класса "Product".
$product = new Product();
//Получаем все значения из таблицы "catalogue".
$product = $product -> getOne(1);

$product -> title = 'Чайник';
$product -> description = 'Очень крутой чайник';
$product -> brand = 'Лялякомпани';

$product -> update();

