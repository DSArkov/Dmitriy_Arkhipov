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

    /**
     * Функция возвращает название таблицы БД, к которой будем обращаться.
     * @return string - Название таблицы.
     */
    public static function getTableName() {
        return 'orders';
    }

    /**
     * Метод добавляет новую строку в таблицу БД.
     */
    public function insert() {}

    /**
     * Метод удаляет строку из таблицы БД.
     */
    public function update() {}
}