<?php

//Регистрируем класс в пространстве имен "app\controllers".
namespace app\controllers;

//Используем классы:
use app\base\App;
use app\models\Cart;
use app\models\repositories\ProductRepository;

//Задача контроллера - принятие решения.
//Контроллер "Product" наследуется от абстрактного класса "Controller".
class ProductController extends Controller
{
    /**
     * Метод отображает страницу каталога.
     */
    public function actionIndex()
    {
        $request = App::call()->request;

        //Проверяем была ли нажата кнопка "В корзину".
        if ($request->post('submit')) {
            //Получаем id продукта с помощью POST запроса.
            $id = $request->post('id');
            //Добавляем его в суперглобальный массив $_SESSION и присваиваем количество.
            (new Cart())->addToCart($id);
        }

        //Получаем продукты из базы данных.
        $model = (new ProductRepository())->getAllObjects();
        //Выводим их на экран.
        echo $this->render('catalogue', ['model' => $model]);
    }

    /**
     * Метод выводит карточку товара на экран.
     */
    public function actionCard()
    {
        //$session = App::call()->session;
        $request = App::call()->request;

        //Проверяем была ли нажата кнопка "В корзину".
        if ($request->post('submit')) {
            //Получаем id продукта с помощью POST запроса.
            $id = $request->post('id');
            //Добавляем его в суперглобальный массив $_SESSION и присваиваем количество.
            (new Cart())->addToCart($id);
        }

        //Получаем id запрашиваемого продукта.
        $id = $request->get('id');
        //Получаем данные о продукте из базы данных.
        //(new ProductRepository())-внешние скобки позволяют выз. экз-р класса на лету(без сохр. в переменную).
        $model = (new ProductRepository())->getObject($id); //Product::getObject($id);
        //Выводим на экран.
        echo $this->render('card', ['model' => $model]);
    }
}