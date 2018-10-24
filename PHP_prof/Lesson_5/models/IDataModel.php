<?php

//Регистрируем класс в пространстве имен "app\models".
namespace app\models;

//Создаем интерфейс, который указывает, какие методы должен реализовать зависимые классы.
interface iDataModel
{
    public static function getTableName();

    public static function getOne($id);

    public static function getAll();

    public static function getObject($id);

    public static function getAllObjects();

    public function insert();

    public function update();

    public function save();

    public function delete();
}