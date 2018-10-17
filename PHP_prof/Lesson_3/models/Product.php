<?php

//Регистрируем класс в пространстве имен "app\models".
namespace app\models;
//Задаём псевдоним для "app\services\iDb".
use app\services\iDb as iDb;

//Создаем класс "Product", который наследуется от "Model".
class Product extends Model
{
    //Объявляем переменные.
    public $db;
    public $id;
    public $title;
    public $description;
    public $price;
    public $manufacturerId;

    /**
     * Конструктор класса. Выполняется в тот момент, когда мы создаем новый экземпляр.
     * @param int $id - id продукта.
     * @param string $title - Название.
     * @param string $description - Описание.
     * @param int $price - Стоимость товара.
     * @param int $manufacturerId - id производителя.
     */
    public function __construct($id = null, $title = null, $description = null, $price = null, $manufacturerId = null)
    {
        //Используем родительский конструктор. = null
        parent:: __construct();
        //Присваиваем значения переменным.
        $this -> id = $id;
        $this -> title = $title;
        $this -> description = $description;
        $this -> price = $price;
        $this -> manufacturerId = $manufacturerId;
    }

    /**
     * Функция возвращает название таблицы БД, к которой будем обращаться.
     * @return string - Название таблицы.
     */
    public function getTableName() {
        return 'products';
    }
}