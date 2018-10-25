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
     * Метод отображает страницу каталога.
     */
    public function actionIndex() {
        //Получаем продукты из базы данных.
        $model = Product::getAllObjects();
        //Выводим их на экран.
        echo $this -> render('catalogue', ['model' => $model]);
    }

    /**
     * Метод выводит карточку товара на экран.
     */
    public function actionCard() {
        //В случае, если мы не хотим отображать layout ->
        $this -> useLayout = false; //--------Если используем шаблонизатор Twig-обязательно.--------

        //Получаем id запрашиваемого продукта.
        $id = $_GET['id'];
        //Получаем данные о продукте из базы данных.
        $model = Product::getObject($id);
        //Выводим на экран.
        echo $this -> render('card', ['model' => $model]);
    }
}