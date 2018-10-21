<?php

//Регистрируем класс в пространстве имен "app\controllers".
namespace app\controllers;

//Задаём псевдоним для класса "Product".
use app\models\Product as Product;

//Задача контроллера - принятие решения.
//Контроллер "Product" наследуется от абстрактного класса "Controller".
class ProductController extends Controller
{
    /**
     * Экшн отвечает за вывод каталога на экран.
     */
    public function actionIndex() {
        echo "catalogue";
    }

    /**
     * Экшн отвечает за вывод карточки товара на экран.
     */
    public function actionCard() {
        //В случае, если мы не хотим отображать layout ->
        //$this -> useLayout = false;

        //Получаем id запрашиваемого продукта.
        $id = $_GET['id'];
        //Получаем его из базы данных.
        $model = Product::getObject($id);
        //Выводим на экран.
        echo $this -> render('card', ['model' => $model]);
    }
}