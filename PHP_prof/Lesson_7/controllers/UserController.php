<?php

//Регистрируем класс в пространстве имен "app\controllers".
namespace app\controllers;

//Используем классы:
use app\base\App;
use app\models\User;

//Задача контроллера - принятие решения.
//Контроллер "User" наследуется от абстрактного класса "Controller".
class UserController extends Controller
{
    /**
     * Метод выводит информацию о пользователе на экран.
     */
    public function actionCard() {
        //В случае, если мы не хотим отображать layout ->
        //$this -> useLayout = false;

        //Получаем id запрашиваемого продукта.
        $id = App::call() -> request -> get('id');
        //Получаем объект пользователя.
        $model = User::getObject($id);
        //Выводим информацию на экран.
        echo $this -> render('user', ['model' => $model]);
    }
}