<?php

//Регистрируем класс в пространстве имён.
namespace app\controllers;

//Используем класс:
use app\base\App;


//Контроллер для разлогинивания пользователя.
class ExitController extends Controller
{
    /**
     * Метод очищает сессию и делает переадресацию на страницу каталога.
     */
    public function actionIndex()
    {
        //Очищааем сессию.
        App::call()->session->delete();
        //Делаем переадресацию на каталог.
        header('Location: /product');
    }
}