<?php

//Подключаем скрипты.
//include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php'; - Отключен! Используем автолоадер композера.
include $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';

//Используем класс:
//use app\services\Autoloader; - !используем автолоадер композера!.

//Регистрируем автозагрузчик объекта "Autoloader", метод "loadClass". - Отключен! Используем автолоадер композера.
//spl_autoload_register([new Autoloader(), 'loadClass']);

//Запускаем приложение.
(new \app\base\App()) -> run([]);

