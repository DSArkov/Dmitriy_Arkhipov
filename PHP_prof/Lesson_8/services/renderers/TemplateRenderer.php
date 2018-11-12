<?php

//Регистрируем класс в пространстве имён.
namespace app\services\renderers;

//Используем класс:
use app\base\App;


//Класс для подготовки шаблона.
class TemplateRenderer implements IRenderer
{
    /**
     * Метод передаёт данные в шаблон, который выводится на экран.
     * @param string $template - Имя шаблона.
     * @param array $params - Переменные, которые подставляются.
     * @return false|string - Возвращает данные, сохраненные в буфере.
     */
    public function render($template, $params = [])
    {
        //Включаем буферизацию вывода.
        ob_start();
        //Из ассоциативного массива создаём переменные с именами ключей и их значениями.
        extract($params);
        //Подключаем шаблон.
        include App::call()->config['templatesDir'] . $template . ".php";
        //Забираем данные с буфера и вовращаем их. При этом очищая сам буфер.
        return ob_get_clean();
    }
}