<?php

//Подключаем скрипты.
//TODO: Убрать зависимость от подключения main.php вручную, т.к. он подключается через автолоадер композера.
$config = include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
include $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';


//Используем класс:
//use app\services\Autoloader; - !используем автолоадер композера!.

//Регистрируем автозагрузчик объекта "Autoloader", метод "loadClass". - Отключен! Используем автолоадер композера.
//spl_autoload_register([new Autoloader(), 'loadClass']);

//Запускаем приложение.
\app\base\App::call() -> run($config);