<?php

//Регистрируем класс в пространстве имен "app\models".
namespace app\models;

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

    /**
     * Метод добавляет новую строку в таблицу БД.
     */
    public function insert() {}

    /**
     * Метод удаляет строку из таблицы БД.
     */
    public function update() {}
}