<?php

//Регистрируем класс в пространстве имен "app\models".
namespace app\models;
//Задаём псевдоним для "app\services\iDb".
use app\services\iDb as iDb;

//Создаем класс "Cart", который наследуется от "Model".
class Cart extends Model
{
    //Объявляем переменные.
    public $productId;
    public $productTitle;
    public $count;
    public $productPrice;
    public $totalPrice;

    /**
     * Функция возвращает название таблицы БД, к которой будем обращаться.
     * @return string - Название таблицы.
     */
    public function getTableName() {
        return 'cart';
    }

    public function getClassName() {
        return __CLASS__;
    }
}