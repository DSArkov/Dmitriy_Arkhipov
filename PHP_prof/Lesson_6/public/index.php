<?php

//Подключаем скрипты.
//include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php'; - используем автолоадер композера.
include $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';

//Задаём псевдонимы для классов.
//use app\services\Autoloader as Autoloader; - используем автолоадер композера.
use \app\services\renderers\TemplateRenderer as TemplateRenderer;

//Создаём новый экземпляр класса "Request".
$request = new \app\services\Request();

//Регистрируем автозагрузчик объекта "Autoloader", метод "loadClass". - используем автолоадер композера.
//spl_autoload_register([new Autoloader(), 'loadClass']);

//Получаем имя контроллера.
$controllerName = $request -> getControllerName() ? : DEFAULT_CONTROLLER;
//Получаем имя экшена.
$actionName = $request -> getActionName();

//Формируем название класса контроллера.
$controllerClass = CONTROLLERS_NAMESPACE . '\\' . ucfirst($controllerName) . 'Controller';

//Если таковой существует -
if (class_exists($controllerClass)) {
    //создаём новый объект от этого класса.
    $controller = new $controllerClass(new TemplateRenderer());
    //Запускаем его.
    $controller -> run($actionName);
}
