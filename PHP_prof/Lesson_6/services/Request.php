<?php

namespace app\services;

//Данный класс предназначен для получения данных о запросе.
class Request
{
    //Создаём приватные свойства.
    private $requestString;
    private $controllerName;
    private $actionName;
    private $params;

    /**
     * Конструктор класса. Выполняется в тот момент, когда мы создаём новый экземпляр.
     */
    public function __construct()
    {
        $this -> requestString = $_SERVER['REQUEST_URI'];
        $this -> parseRequest();
    }


    /**
     * Метод разпарсивает запрос и получает необходимые данные.
     */
    public function parseRequest() {
        //Сохраняем регулярное выражение в переменную, задавая псевдонимы необходимым значениям.
        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";
        //Проверяем есть ли совпвдения.
        if (preg_match_all($pattern, $this -> requestString, $matches)) {
            //Сохраняем имя контроллера в параметр.
            $this -> controllerName = $matches['controller'][0];
            //Сохраняем имя экшена.
            $this -> actionName = $matches['action'][0];
            //Получеам параметры, если они были переданы GET методом.
            $this -> params['get'] = $_GET;
            //Получаем параметры, если они были переданы POST методом.
            $this -> params['post'] = $_POST;
        }
    }

    /**
     * Метод для получения доступа к свойству "controllerName".
     * @return string - Возвращает строку с именем контроллера.
     */
    public function getControllerName() {
        return $this -> controllerName;
    }

    /**
     * Метод для получения доступа к свойству "actionName".
     * @return string - Возвращает строку с именем экшена.
     */
    public function getActionName() {
        return $this -> actionName;
    }

    /**
     * Метод для получения доступа к свойству "params".
     * @return array - Возвращает массив с параметрами.
     */
    public function getParams() {
        return $this -> params;
    }

    /**
     * Метод для получения доступа к элементу свойства "params" и ключом "get", если таковые существуют.
     * @param string $name - Имя параметра.
     * @return string - Возвращает значение параметра.
     */
    public function get($name) {
        if (isset($this -> params['get'][$name])) {
            return $this -> params['get'][$name];
        }
    }

    /**
     * Метод для получения доступа к элементу свойства "params" и ключом "post", если таковые существуют.
     * @param string $name - Имя параметра.
     * @return string - Возвращает значение параметра.
     */
    public function post($name) {
        if (isset($this -> params['post'][$name])) {
            return $this -> params['post'][$name];
        }
    }
}