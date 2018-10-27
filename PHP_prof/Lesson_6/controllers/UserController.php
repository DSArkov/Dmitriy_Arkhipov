<?php

//Регистрируем класс в пространстве имен "app\controllers".
namespace app\controllers;

use app\models\User as User;

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
        $id = $_GET['id'];
        //Получаем объект пользователя.
        $model = User::getObject($id);
        //Выводим информацию на экран.
        echo $this -> render('user', ['model' => $model]);
    }
}