<?php

//Регистрируем класс в пространстве имен.
namespace app\controllers;


//Используем классы:
use app\base\App;
use app\models\Cart;


//Контроллер корзины.
class CartController extends Controller
{
    /**
     * Метод для отображения страницы корзины.
     */
    public function actionIndex()
    {
        //Стартуем сессию либо возобнавляем существующую.
        $session = App::call()->session;

        //TODO: Сессия.
        //Проверяем, есть ли в ней массив "users".
        if (!$user_id = $_SESSION['users']) {
            //Если нет - делаем переадресацию на страницу каталога.
            header('Location: /product');
        }

        //Создаём новый объект класса "Request" либо используем уже существующий.
        $request = App::call()->request;

        //Проверяем была ли нажата кнопка "Удалить".
        if ($request->post('delete')) {
            //Получаем id продукта с помощью POST запроса.
            $cart_id = $request->post('cart_id');
            //Вызываем метод класса "Cart" для удаления товара из корзины.
            (new Cart)->deleteFromCart($cart_id);
        }

        //Получаем данные о товрах, находящихся в массиве "$_SESSION".
        $arrProd = (new Cart)->getCartProd($session->get('cart'));
        //Вызываем функцию для отрисовки шаблона.
        //TODO: Сессия.
        echo $this->render('cart', ['arrProd' => $arrProd, 'login' => $_SESSION['users']['login']]);
    }
}