<?php

//Регистрируем класс в пространстве имен "app\traits".
namespace app\traits;

trait TSingleton
{
    //Создаем защищенное статическое свойство для хранения единственного экземпляра Db.
    protected static $instance;

    //Запрещаем создание объекта.
    private function __construct() {}
    //Запрещаем клонирование объекта.
    private function __clone() {}
    //Запрещаем восстановление объекта из серриализованных данных.
    private function __wakeup() {}

    public static function getInstance() {;
        //Проверяем пустое ли статическое свойство $instance.
        if (is_null(static::$instance)) {
            //Создаём новый экземпляр текущего класса.
            //static использует позднее статическое связывание.
            static::$instance = new static();
        }
        //Если такой объект уже создан, то возвращаем его.
        return static::$instance;
    }
}