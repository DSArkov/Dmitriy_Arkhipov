<?php

//Регистрируем класс в пространстве имен "app\models".
namespace app\models;
//Задаём псевдоним для "app\services\iDb".
use app\services\iDb as iDb;

//Создаем класс "Order", который наследуется от "Model".
class Order extends Model
{
    //Объявляем переменные.
    public $productId;
    public $productTitle;
    public $count;
    public $productPrice;
    public $totalPrice;
    public $userName;
    public $address;

    /**
     * Конструктор класса. Выполняется в тот момент, когда мы создаем новый экземпляр.
     * @param iDb $db - Объект для работы с БД.
     * @param int $productId - id продукта.
     * @param string $productTitle - Название товара.
     * @param int $count - Его количество.
     * @param int $productPrice - Стоимость продукта.
     * @param int $totalPrice - Общая цена.
     * @param string $userName - Имя пользователя.
     * @param string $address - Адрес доставки.
     */
    public function __construct($db, $productId, $productTitle, $count, $productPrice, $totalPrice, $userName, $address)
    {
        //Используем родительский конструктор.
        parent:: __construct($db);
        //Присваиваем значения переменным.
        $this -> productId = $productId;
        $this -> productTitle = $productTitle;
        $this -> count = $count;
        $this -> productPrice = $productPrice;
        $this -> totalPrice = $totalPrice;
        $this -> userName = $userName;
        $this -> address = $address;
    }

    /**
     * Функция возвращает название таблицы БД, к которой будем обращаться.
     * @return string - Название таблицы.
     */
    public function getTableName() {
        return 'orders';
    }
}