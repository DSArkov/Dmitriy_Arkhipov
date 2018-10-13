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
     * Конструктор класса. Выполняется в тот момент, когда мы создаем новый экземпляр.
     * @param iDb $db - Объект для работы с БД.
     * @param int $id - id пользователя.
     * @param string $login - Логин.
     * @param string $password - Пароль.
     */
    public function __construct($db, $id, $login, $password)
    {
        //Используем родительский конструктор.
        parent:: __construct($db);
        //Присваиваем значения переменным.
        $this -> id = $id;
        $this -> login = $login;
        $this -> password = $password;
    }

    /**
     * Функция возвращает название таблицы БД, к которой будем обращаться.
     * @return string - Название таблицы.
     */
    public function getTableName() {
        return 'users';
    }
}