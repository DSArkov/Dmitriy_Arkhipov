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
     * Конструктор класса. Выполняется в тот момент, когда мы создаем новый экземпляр.
     * @param iDb $db - Объект для работы с БД.
     * @param int $productId - id продукта.
     * @param string $productTitle - Название товара.
     * @param int $count - Его количество.
     * @param int $productPrice - Стоимость.
     * @param string $totalPrice - Общая цена.
     */
    public function __construct($db, $productId, $productTitle, $count, $productPrice, $totalPrice)
    {
        //Используем родительский конструктор.
        parent:: __construct($db);
        //Присваиваем значения переменным.
        $this -> productId = $productId;
        $this -> productTitle = $productTitle;
        $this -> count = $count;
        $this -> productPrice = $productPrice;
        $this -> totalPrice = $totalPrice;
    }

    /**
     * Функция возвращает название таблицы БД, к которой будем обращаться.
     * @return string - Название таблицы.
     */
    public function getTableName() {
        return 'cart';
    }
}