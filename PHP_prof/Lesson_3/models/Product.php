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
    public $className = __CLASS__;

    /**
     * Функция возвращает название таблицы БД, к которой будем обращаться.
     * @return string - Название таблицы.
     */
    public function getTableName() {
        return 'catalogue';
    }

    /**
     * Функция возвращает имя текущаего класса.
     * @return string -Имя класса.
     */
    public function getClassName() {
        return __CLASS__;
    }

    public function create() {
        $sql = "INSERT INTO {$this -> className} (title, description, brand, price, url) values
              (:title, :description, :brand, :price, :url)";
        $this -> db -> execute($sql, [':title' => $this -> title, ':description' => $this -> description,
                ':brand' => $this -> brand, ':price' => $this -> price, ':url' => $this -> url]);
    }

    public function update() {
        $sql = "UPDATE {$this -> className} SET title = :title, description = :description, brand = :brand,
              price = :price, url = :url WHERE id = :id";
        $this -> db -> execute($sql, $sql, [':title' => $this -> title, ':description' => $this -> description,
            ':brand' => $this -> brand, ':price' => $this -> price, ':url' => $this -> url]);
    }
}