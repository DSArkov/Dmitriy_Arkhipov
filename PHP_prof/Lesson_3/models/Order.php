<?php

//Регистрируем класс в пространстве имен "app\models".
namespace app\models;

//Создаем класс "Order", который наследуется от "Model".
class Order extends Model
{
    //Объявляем переменные.
    public $id;
    public $id_user;
    public $date;
    public $status;
    public $total_cost;
    public $className = __CLASS__;

    /**
     * Функция возвращает название таблицы БД, к которой будем обращаться.
     * @return string - Название таблицы.
     */
    public function getTableName() {
        return 'orders';
    }
}