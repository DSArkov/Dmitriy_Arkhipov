<?php

//Регистрируем класс в пространстве имен "app\models".
namespace app\models;
//Задаём псевдоним для "app\services\iDb".
use app\services\iDb as iDb;

//Создаем класс "User", который наследуется от "Model".
class User extends Model
{
    //Объявляем переменные.
    public $id;
    public $login;
    public $password;

    /**
     * Функция возвращает название таблицы БД, к которой будем обращаться.
     * @return string - Название таблицы.
     */
    public function getTableName() {
        return 'users';
    }

    public function getClassName() {
        return __CLASS__;
    }
}