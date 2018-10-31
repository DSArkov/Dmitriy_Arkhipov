<?php

//Регистрируем класс в пространстве имен "app\models\repositories".
namespace app\models\repositories;

//Используем класс "Order".
use app\models\Order;


//Класс-хранилище для заказов.
class OrderRepository extends Repository
{
    /**
     * Метод возвращает название таблицы БД, к которой будем обращаться.
     * @return string - Название таблицы.
     */
    public function getTableName() {
        return 'orders';
    }

    /**
     * Метод возвращает имя класса "Order".
     * @return string - Имя класса.
     */
    public function getEntityClass() {
        return Order::class;
    }
}