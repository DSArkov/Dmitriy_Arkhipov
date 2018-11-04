<?php

//Регистрируем класс в пространстве имён.
namespace app\base;

//Используем классы:
use app\services\renderers\TemplateRenderer;
use app\traits\TSingleton;


//Класс-обёртка отвечающий за работу всего приложения.
class App
{
    //Подмешиваем трейт "Singleton".
    use TSingleton;

    //Свойство, в котором хранится конфигурация.
    public $config;
    //Создаём приватное свойство для хранения экземпляра класса "Storage".
    private $components;

    /**
     * Метод вызывает статический метод "getInstance()" трейта "TSingleton".
     * @return object - Возвращает текущий объект.
     */
    public static function call() {
        return static::getInstance();
    }

    /**
     * Метод запускает приложение.
     * @param array $config - Конфигурация.
     */
    public function run($config) {
        //Сохраняем конфигурацию в свойство "$config".
        $this -> config = $config;
        //Создаём и сохраняем экземпляр хранилища.
        $this -> components = new Storage();
        //Запускаем метод для определения необходимого контроллера.
        $this -> runController();
    }

    /**
     * Метод определяет какой контроллер запускать.
     */
    private function runController() {
        //Получаем имя контроллера.
        $controllerName = $this -> request -> getControllerName() ?: $this -> config['defaultController'];
        //Получаем имя экшена.
        $actionName = $this -> request -> getActionName();

        //Формируем название класса контроллера.
        $controllerClass = $this -> config['controllerNamespace'] . '\\' . ucfirst($controllerName) . 'Controller';

        //Если такой класс существует -
        if (class_exists($controllerClass)) {
            //создаём новый объект от этого класса.
            $controller = new $controllerClass(new TemplateRenderer());
            //Запускаем его.
            $controller->run($actionName);
        }
    }

    /**
     * Метод позволяет создать экземпляр необходимого класса с параметрами, находящимися в хранилище.
     * @param string $key - Ключ, по которому будет осуществлен поиск.
     * @return object - Возвращаем созданный объект.
     */
    public function createComponent($key) {
        //Проверяем, есть ли текущий компонент в хранилище.
        if (isset($this -> config['components'][$key])) {
            //Если да, сохраняем параметры в переменную.
            $params = $this -> config['components'][$key];
            //Получаем класс.
            $class = $params['class'];
            //Если такой класс существует.
            if (class_exists($class)) {
                //Удаляем 'class' из массива параметров, т.к. в конструкторе он не нужен.
                unset($params['class']);
                //Создаём объект класса "Reflection", который позволяет создать объект необходимого класса.
                $reflection = new \ReflectionClass($class);
                //И передать параметры в конструктор. После возвращаем его.
                return $reflection -> newInstanceArgs($params);
            }
        }
    }

    /**
     * Магический метод для перехвата свойств, которых нет в текущем классе.
     * @param string $name - Имя компонента.
     * @return mixed - Возвращает компонент.
     */
    public function __get($name) {
        //Обращаемся к хранилищу для получения компонента.
        return $this -> components -> get($name);
    }

}