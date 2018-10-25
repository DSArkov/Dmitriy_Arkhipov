<?php

//Подключаем скрипты.
//include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php'; - используем автолоадер композера.
include $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';

//Задаём псевдонимы для классов.
//use app\services\Autoloader as Autoloader; - используем автолоадер композера.
use \app\services\renderers\TemplateRenderer as TemplateRenderer;
use \app\services\renderers\TwigRenderer as TwigRenderer;

//Регистрируем автозагрузчик объекта "Autoloader", метод "loadClass". - используем автолоадер композера.
//spl_autoload_register([new Autoloader(), 'loadClass']);

//Получаем имя контроллера из GET-запроса и задаём контроллер по умолчанию.
$controllerName = $_GET['c'] ? : DEFAULT_CONTROLLER;
//Получаем имя экшена.
$actionName = $_GET['a'];

//Формируем название класса контроллера.
$controllerClass = CONTROLLERS_NAMESPACE . '\\' . ucfirst($controllerName) . 'Controller';

//Если таковой существует -
if (class_exists($controllerClass)) {
    //создаём новый объект от этого класса.
    $controller = new $controllerClass(new TwigRenderer()); //TwigRenderer если исп. шаблонизатор
    //Запускаем его.
    $controller -> run($actionName);
}
