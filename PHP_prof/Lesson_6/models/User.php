<?php

//Регистрируем класс в пространстве имен "app\models".
namespace app\models;

//Создаем класс "User", который наследуется от "DataEntity".
class User extends DataEntity
{
    //Объявляем переменные.
    public $id;
    public $name;
    public $login;
    public $password;

    /**
     * Функция возвращает название таблицы БД, к которой будем обращаться.
     * @return string - Название таблицы.
     */
    public static function getTableName() {
        return 'users';
    }
}