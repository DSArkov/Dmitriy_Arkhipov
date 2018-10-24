<?php

//Регистрируем класс в пространстве имен "app\controllers".
namespace app\controllers;

//Задаём псевдоним для класса "app\services\renderers\TemplateRenderer".
use app\services\renderers\IRenderer;
use app\services\renderers\TemplateRenderer as TemplateRenderer;

/**
 * Контроллер - родитель.
 */
abstract class Controller
{
    //Свойство для хранения исполняемого экшена.
    private $action;
    //Экшн по умолчанию.
    private $defaultAction = 'index';
    //Переменная содержит в себе название шаблона.
    private $layout = 'main';
    //Переменная хранит значение, используется шаблон или нет.
    private $useLayout = true;
    //Переменная для хранения экземпляра класса, который зависит от интерфейса IRenderer.
    private $renderer = null;

    /**
     * Конструктор класса. Выполняется в тот момент, когда мы создаём новый экземпляр.
     * @param object $renderer - Устанавливаем прямую зависимость от интерфейса IRenderer.
     */
    public function __construct(IRenderer $renderer)
    {
        $this -> renderer = $renderer;
    }

    /**
     * Метод запускает полученный экшн и если ничего не пришло - использует экшн по умолчанию.
     * @param string $action - Вызванный экшн.
     */
    public function run($action = null) {
        //Сохраняем текущий экшн в свойстве. Если он не пришел - вызываем экшн по умолчанию.
        $this -> action = $action ?: $this -> defaultAction;
        //Формируем его имя и сохраняем в переменную.
        $method = "action" . ucfirst($this -> action);
        //Если такой метод существует -
        if (method_exists($this, $method)) {
            //вызываем его.
            $this -> $method();
        } else {
            //Иначе сообщаем об ошибке.
            echo '404';
        }
    }

    /**
     * Метод проверяет, используется шалон или нет, после чего отображает данные на экране.
     * @param string $template - Имя шалона.
     * @param array $params - Массив с переменными для подстановки в шаблон.
     * @return false|string - Возвращает шаблон с текущми параметрами.
     */
    public function render($template, $params) {
        //Если мы используем шалон.
        if ($this -> useLayout) {
            //Отображаем шалон на экране.
            $content = $this -> renderTemplate($template, $params);
            //Вставляем в него необходимые параметры.
            return $this -> renderTemplate("layouts/{$this -> layout}", ['content' => $content]);
        }
        //Отображаем шаблон сам по себе.
        return $this -> renderTemplate($template, $params);
    }

    /**
     * Метод вызывает метод "render" класса "TemplateRenderer", который отображает наш шаблон.
     * @param string $template - Имя шаблона.
     * @param array $params - Переменные, которые должны подставляться.
     * @return false|string - Возвращает данные, сохраненные в буфере и выводит их на экран.
     */
    public function renderTemplate($template, $params) {
        return $this -> renderer -> render($template, $params);
    }
}