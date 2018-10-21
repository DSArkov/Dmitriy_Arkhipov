<?php

//Подключаем скрипты.
include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
include ROOT_DIR . 'services/Autoloader.php';

//Задаём псевдоним для "app\services\Db".
use app\services\Autoloader as Autoloader;

//Регистрируем автозагрузчик объекта "Autoloader", метод "loadClass".
spl_autoload_register([new Autoloader(), 'loadClass']);

//Получаем имя контроллера из GET-запроса и задаём контроллер по умолчанию.
$controllerName = $_GET['c'] ? : DEFAULT_CONTROLLER;
//Получаем имя экшена.
$actionName = $_GET['a'];

//Формируем название класса контроллера.
$controllerClass = CONTROLLERS_NAMESPACE . '\\' . ucfirst($controllerName) . 'Controller';

//Если таковой существует -
if (class_exists($controllerClass)) {
    //создаём новый объект от этого класса.
    $controller = new $controllerClass;
    //Запускаем его.
    $controller -> run($actionName);
}
