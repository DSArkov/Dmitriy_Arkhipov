<?php

//Регистрируем класс в пространстве имен "app\models".
namespace app\models;

//Создаем класс "Product", который наследуется от "Model".
class Product extends Model
{
    //Объявляем переменные.
    public $id;
    public $title;
    public $description;
    public $brand;
    public $price;
    public $url;

    /**
     * Метод возвращает название таблицы БД, к которой будем обращаться.
     * @return string - Название таблицы.
     */
    public static function getTableName() {
        return 'catalogue';
    }
}