<?php

//Регистрируем класс в пространстве имён.
namespace app\controllers;


//Контроллер ошибок.
class RequestErrController extends Controller
{
    /**
     * Метод выводит на экран ошибку "404".
     */
    public function actionIndex()
    {
        //Отключаем основной шаблон.
        $this->useLayout = false;
        //Вызываем метод для отображения страницы с ошибкой.
        echo $this->render('error', []);
    }
}