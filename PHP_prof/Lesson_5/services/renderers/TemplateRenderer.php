<?php

namespace app\services\renderers;

/**
 * Метод передаёт данные в шаблон, который выводит на экран.
 * @param string $template - Имя шаблона.
 * @param array $params - Переменные, которые должны подставляться.
 * @return false|string - Возвращает данные, сохраненные в буфере.
 */
class TemplateRenderer implements IRenderer
    {
    public function render($template, $params = []) {
        //Включаем буферизацию вывода.
        ob_start();
        //Из ассоциативного массива создаём переменные с именами ключей и их значениями.
        extract($params);
        //Подключаем шаблон.
        include TEMPLATES_DIR . $template . ".php";
        //Забираем данные с буфера и вовращаем их. При этом очищая сам буфер.
        return ob_get_clean();
    }
}