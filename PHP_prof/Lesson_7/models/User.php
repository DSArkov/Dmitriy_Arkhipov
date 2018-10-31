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
}