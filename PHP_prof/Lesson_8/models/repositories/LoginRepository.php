<?php

//Регистрируем класс в пространстве имен "app\models\repositories".
namespace app\models\repositories;

//Используем класс "User".
use app\base\App;
use app\models\User;


//Класс-хранилище для пользователей.
class LoginRepository
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

    /**
     * Функция делает запрос в БД для получения данных о пользователе.
     * @param string $login - Логин пользователя.
     * @param string $password - Пароль пользователя.
     * @return array|null - Возвращает массив с данными.
     */
    function getUserByLoginPass($login, $password) {
        $table = static::getTableName();
        //Возвращаем результат выполнения запроса.
        return App::call()->db->queryOne("SELECT * FROM {$table} WHERE login = '{$login}' AND password = '{$password}'");
    }
}