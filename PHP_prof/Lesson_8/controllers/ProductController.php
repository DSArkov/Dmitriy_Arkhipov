<?php

//Регистрируем класс в пространстве имен "app\controllers".
namespace app\controllers;

//Используем классы:
use app\base\App;
use app\models\Cart;
use app\models\repositories\ProductRepository;


//Контроллер товаров.
class ProductController extends Controller
{
    /**
     * Метод отображает страницу каталога.
     */
    public function actionIndex()
    {
        //Запускаем сессию или используем существующую.
        $session = App::call()->session;
        //Создаём экземпляр класса "Request", либо используем существующий.
        $request = App::call()->request;

        //Проверяем была ли нажата кнопка "В корзину".
        if ($request->post('submit')) {
            //Получаем id продукта с помощью POST запроса.
            $id = $request->post('id');
            //Вызываем метод для добавления товара в корзину.
            (new Cart())->addToCart($id);
        }

        //Получаем продукты из базы данных.
        $model = (new ProductRepository())->getAllObjects();
        //Выводим их на экран.
        //TODO: Сесссия.
        echo $this->render('catalogue', ['model' => $model, 'login' => $_SESSION['users']['login']]);
    }

    /**
     * Метод выводит карточку товара на экран.
     */
    public function actionCard()
    {
        //Запускаем сессию или используем существующую.
        $session = App::call()->session;
        //Создаём экземпляр класса "Request", либо используем существующий.
        $request = App::call()->request;

        //Проверяем была ли нажата кнопка "В корзину".
        if ($request->post('submit')) {
            //Получаем id продукта с помощью POST запроса.
            $id = $request->post('id');
            //Вызываем метод для добавления товара в корзину.
            (new Cart())->addToCart($id);
        }

        //Получаем id запрашиваемого продукта.
        $id = $request->get('id');
        //Получаем данные о продукте из базы данных.
        //(new ProductRepository())-внешние скобки позволяют выз. экз-р класса на лету(без сохр. в переменную).
        $model = (new ProductRepository())->getObject($id);
        //Выводим на экран.
        //TODO: Сессия.
        echo $this->render('card', ['model' => $model, 'login' => $_SESSION['users']['login']]);
    }
}