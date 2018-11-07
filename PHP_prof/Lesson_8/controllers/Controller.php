<?php

//Регистрируем класс в пространстве имен.
namespace app\controllers;

//Используем классы:
use app\services\renderers\IRenderer;


//Контроллер - родитель.
abstract class Controller
{
    //Свойство для хранения исполняемого экшена.
    protected $action;
    //Экшн по умолчанию.
    protected $defaultAction = 'index';
    //Переменная содержит в себе название шаблона.
    protected $layout = 'main';
    //Указываем используется layout или нет.
    protected $useLayout = true;
    //Переменная для хранения экземпляра класса, который зависит от интерфейса IRenderer.
    protected $renderer = null;


    /**
     * Конструктор класса. Выполняется в тот момент, когда мы создаём новый экземпляр.
     * @param IRenderer $renderer - Устанавливаем прямую зависимость от интерфейса IRenderer.
     */
    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Метод запускает полученный метод и если ничего не пришло - использует метод по умолчанию.
     * @param string $action - Название метода.
     * @throws \Exception - Исключение.
     */
    public function run($action = null)
    {
        //Сохраняем текущий метод в свойстве. Ничего не передали - вызываем метод по умолчанию.
        $this->action = $action ?: $this->defaultAction;
        //Формируем имя метода и сохраняем в переменную.
        $method = "action" . ucfirst($this->action);

        //Проверям, существует ли такой метод.
        if (method_exists($this, $method)) {
            //Если да, вызываем его.
            $this->$method();
        } else {
            //Иначе выбрасываем исключение.
            throw new \Exception('Нет такого экшена.');
        }
    }

    /**
     * Метод проверяет, используется шаблон или нет, после чего отображает данные на экране.
     * @param string $template - Имя шаблона.
     * @param array $params - Массив с переменными для подстановки в шаблон.
     * @return false|string - Возвращает шаблон с текущми параметрами.
     */
    public function render($template, $params)
    {
        //Если мы используем шаблон.
        if ($this->useLayout) {
            //Получаем его.
            $content = $this->renderTemplate($template, $params);
            //Передаём необходимые параметры и выводим на экран.
            return $this->renderTemplate("layouts/{$this -> layout}", ['content' => $content]);
        }
        //Отображаем шаблон сам по себе.
        return $this->renderTemplate($template, $params);
    }

    /**
     * Метод вызывает метод "render" класса "TemplateRenderer", который отображает наш шаблон.
     * @param string $template - Имя шаблона.
     * @param array $params - Переменные, которые должны подставляться.
     * @return false|string - Возвращает данные, сохраненные в буфере и выводит их на экран.
     */
    public function renderTemplate($template, $params)
    {
        return $this->renderer->render($template, $params);
    }
}