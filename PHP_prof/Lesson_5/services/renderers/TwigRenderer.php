<?php

//Регистрируем класс в пространстве имен "app\services\renderers".
namespace app\services\renderers;

//Класс формирует переменные и данные для шаблонизатора Twig.
class TwigRenderer implements IRenderer
{
    /**
     * Метод передаёт данные в шаблон, который выводится на экран.
     * @param string $template - Имя шаблона.
     * @param array $params - Переменные, которые подставляются.
     * @return false|string - Возвращает данные, сохраненные в буфере.
     */
    public function render($template, $params = []) {
        try {
        //Указываем, где хранятся шаблоны.
        $loader = new \Twig_Loader_Filesystem(TWIG_DIR);
        //Инициализируем Твиг.
        $twig = new \Twig_Environment($loader, array(
            'cache' => '../cache'
        ));
        //Передаём содержимое и возвращаем готовый шаблон.
        return $twig -> render($template . '.twig', $params);
        //Обрабатываем ошибки, если таковые имеются.
        } catch (\Exception $e) {
            die ('Error: ' . $e -> getMessage());
        }
    }
}