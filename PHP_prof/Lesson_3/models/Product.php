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

//    /**
//     * Метод добавляет новую строку в таблицу БД.
//     */
//    public function insert() {
//        //Сохраняем SQL-запрос в переменную.
//        $sql = "INSERT INTO {$this -> getTableName()} (title, description, brand, price, url) values
//              (:title, :description, :brand, :price, :url)";
//        //Делаем запрос в БД, передавая необходимые параметры.
//        $this -> db -> execute($sql, [':title' => $this -> title, ':description' => $this -> description,
//                ':brand' => $this -> brand, ':price' => $this -> price, ':url' => $this -> url]);
//    }
//
//    /**
//     * Метод удаляет строку из таблицы БД.
//     */
//    public function update() {
//        //Сохраняем SQL-запрос в переменную.
//        $sql = "UPDATE {$this -> getTableName()} SET (title = :title, description = :description, brand = :brand,
//              price = :price, url = :url) WHERE id = :id";
//        //Делаем запрос в БД, передавая необходимые параметры.
//        $this -> db -> execute($sql, [':title' => $this -> title, ':description' => $this -> description,
//            ':brand' => $this -> brand, ':price' => $this -> price, ':url' => $this -> url, ':id' => $this -> id]);
//    }
}