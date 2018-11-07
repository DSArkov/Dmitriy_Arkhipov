<?php

//регистрируем класс в пространстве имён.
namespace app\controllers;

//Используем классы:
use app\base\App;
use app\models\repositories\OrderRepository;


//Контроллер для работы с заказами.
class OrderController extends Controller
{
    public function actionIndex()
    {
        //Запускаем сессию или используем существующую.
        $session = App::call()->session;
        //Создаём экземпляр класса "Request", либо используем существующий.
        $request = App::call()->request;

        //Проверяем, пришли ли нам данные методом "POST".
        if ($request->isPost()) {
            //Если да, то сохраняем в переменную id заказа.
            $id_order = $request->post('id_order');
            //Вызываем метод для изменения статуса.
            (new OrderRepository())->changeStatus($id_order);
        }

        //Проверяем была ли нажата кнопка "Оформить заказ".
        if ($request->post('add_order')) {
            //Если да, то вызываем метод для добавления информации о заказе в БД.
            (new OrderRepository())->addOrder();
        }

        //Получаем информацию о заказах из MySQL.
        $arr_orders = (new OrderRepository())->getOrder();

        //TODO:Сессия.
        //Вызываем метод для отрисовки шаблона, передавая необходимые параметры.
        echo $this->render('orders', ['arr_order' => $arr_orders, 'login' => $_SESSION['users']['login']]);
    }

}