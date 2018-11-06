<?php

namespace app\controllers;
use app\base\App;
use app\models\repositories\OrderRepository;


class OrderController extends Controller
{

    public function actionIndex()
    {
        $request = App::call()->request;

        //Проверяем, пришли ли нам данные методом "POST".
        if ($request->isPost()) {
            //Если да, то сохраняем в переменную id заказа.
            $id_order = $request->post('id_order');
            //Вызываем функцию для изменения статуса.
            (new OrderRepository())->changeStatus($id_order);
        }

        //Проверяем была ли нажата кнопка "Оформить заказ".
        if ($request->post('add_order')) {
            //Если да, то вызываем функцию для добавления информации о заказе в БД.
            (new OrderRepository())->addOrder();
        }

        //Получаем информацию о заказах из MySQL.
        $arr_orders = (new OrderRepository())->getOrder();

        //TODO:Сессия $_SESSION['users']['login']
        //Вызываем функцию для отрисовки шаблона, передавая необходимые параметры.
        echo $this->render('orders', ['arr_order' => $arr_orders, 'login' => '1']);
    }

}