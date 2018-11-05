<?php

//Регистрируем класс в пространстве имен "app\controllers".
namespace app\controllers;


//Задача контроллера - принятие решения.
//Контроллер "Cart" наследуется от абстрактного класса "Controller".
use app\base\App;
use app\models\Cart;

class CartController extends Controller
{
    /**
     * Метод отображает страницу корзины.
     */
    public function actionIndex()
    {
//        //Проверяем, существует ли массив users в сессии.
//        if (!$user_id = $_SESSION['users']) {
//            //Если нет - вызывем функцию для переадресации страницы.
//            redirect('login.php');
//        }
        $request = App::call()->request;

        //Проверяем была ли нажата кнопка "Удалить".
        if ($request->post('delete')) {
            //Получаем id продукта с помощью POST запроса.
            $cart_id = $request->post('cart_id');
            //Вызываем функцию для удаления товара из корзины.
            (new Cart)->deleteFromCart($cart_id);
        }

        //Получаем данные о товрах, находящихся в массиве сессии.
        $arrProd = (new Cart)->getCartProd(App::call()->session->get('cart'));
        //Вызываем функцию для отрисовки шаблона.
        echo $this->render('cart', ['arrProd' => $arrProd]);
    }
}