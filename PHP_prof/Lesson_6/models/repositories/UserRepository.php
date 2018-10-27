<?php

//Регистрируем класс в пространстве имен "app\models\repositories".
namespace app\models\repositories;

//Используем класс "User".
use app\models\User;


//Класс-хранилище для пользователей.
class UserRepository
{
    /**
     * Метод возвращает название таблицы БД, к которой будем обращаться.
     * @return string - Название таблицы.
     */
    public function getTableName() {
        return 'users';
    }

    /**
     * Метод возвращает имя класса "User".
     * @return string - Имя класса.
     */
    public function getEntityClass() {
        return User::class;
    }
}