<?php

//Регистрируем класс в пространстве имен "app\controllers".
namespace app\controllers;

//Используем классы.
//use app\models\Product as Product;
use app\models\repositories\ProductRepository;
use app\services\Request;

//Задача контроллера - принятие решения.
//Контроллер "Product" наследуется от абстрактного класса "Controller".
class ProductController extends Controller
{
    /**
     * Метод отображает страницу каталога.
     */
    public function actionIndex() {
        //Получаем продукты из базы данных.
        $model = (new ProductRepository()) -> getAllObjects();//Product::getAllObjects();
        //Выводим их на экран.
        echo $this -> render('catalogue', ['model' => $model]);
    }

    /**
     * Метод выводит карточку товара на экран.
     */
    public function actionCard() {
        //В случае, если мы не хотим отображать layout ->
        //$this -> useLayout = false;

        //Cоздаём объект класса "Request" и сохраняем его в переменную.
        $request = new Request();
        //Получаем id запрашиваемого продукта.
        $id = ($request) -> get('id');
        //Получаем данные о продукте из базы данных.
        //(new ProductRepository())-внешние скобки позволяют выз. экз-р класса на лету(без сохр. в переменную).
        $model = (new ProductRepository()) -> getObject($id); //Product::getObject($id);
        //Выводим на экран.

//        $entity = new Product();
//        $entity -> title = 'кекс';
//        $entity -> description = 'почти круглый';
//        $entity -> brand = 'булочная 1';
//        $entity -> price = 123;
//        $entity -> url = 'test_url';
//        (new ProductRepository()) -> save($entity);

        echo $this -> render('card', ['model' => $model]);
    }
}