<?php

//Регистрируем класс в пространстве имен "app\services\renderers".
namespace app\services\renderers;


//Создаем интерфейс, который указывает, какие методы должен реализовать зависимые классы.
interface IRenderer
{
    public function render($template, $params = []);
}