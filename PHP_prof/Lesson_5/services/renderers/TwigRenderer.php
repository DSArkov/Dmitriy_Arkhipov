<?php

//Регистрируем класс в пространстве имен "app\services\renderers".
namespace app\services\renderers;

/**
 * Метод передаёт данные в шаблон, который выводится на экран.
 * @param string $template - Имя шаблона.
 * @param array $params - Переменные, которые подставляются.
 * @return false|string - Возвращает данные, сохраненные в буфере.
 */
class TwigRenderer implements IRenderer
{
    public function render($template, $params = []) {
        try {
        //Указываем, где хранятся шаблоны.
        $loader = new \Twig_Loader_Filesystem(TEMPLATES_DIR . 'twig');
        //Инициализируем Твиг.
        $twig = new \Twig_Environment($loader, array(
            'cache' => '../cache'
        ));
        //Передаём содержимое и возвращаем готовый шаблон.
        return $twig -> render($template . '.twig', $params);
        } catch (\Exception $e) {
            exit ('Error: ' . $e -> getMessage());
        }
    }
}