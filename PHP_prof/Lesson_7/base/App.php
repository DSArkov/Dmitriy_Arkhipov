<?php

//Регистрируем класс в пространстве имён.
namespace app\base;

//Используем классы:
use app\services\renderers\TemplateRenderer;
use app\controllers\RequestErrController;


//Класс отвечающий за работу всего приложения.
class App
{
    //Свойство, в котором хранится конфигурация.
    public $config;

    /**
     * Метод запускает приложение.
     * @param array $config - Конфигурация.
     */
    public function run($config) {
        $this -> runController();
    }

    /**
     * Метод определяет какой контроллер запускать.
     */
    private function runController() {
        //Создаём новый экземпляр класса "Request".
        $request = new \app\services\Request();

        //Получаем имя контроллера.
        $controllerName = $request -> getControllerName() ? : DEFAULT_CONTROLLER;
        //Получаем имя экшена.
        $actionName = $request -> getActionName();

        //Формируем название класса контроллера.
        $controllerClass = CONTROLLERS_NAMESPACE . '\\' . ucfirst($controllerName) . 'Controller';
        //Отслеживаем исключение.
        try {
            //Если такой класс существует -
            if (class_exists($controllerClass)) {
                //создаём новый объект от этого класса.
                $controller = new $controllerClass(new TemplateRenderer());
                //Запускаем его.
                $controller->run($actionName);
            } else {
                //Генерируем исключение.
                throw new \Exception('Такого класса нет!');
            }
        //Ловим исключние.
        } catch (\Exception $e) {
            //Создаём экземпляр класса "RequestErrController" и выводим ошибку "404" на экран.
            (new RequestErrController(new TemplateRenderer())) -> actionError();
        }
    }

}