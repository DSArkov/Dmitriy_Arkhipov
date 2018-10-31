<?php

//Регистрируем класс в пространстве имен "app\services".
namespace app\services;

//Используем класс:
use app\traits\TSingleton;

//Класс для работы с сессией.
class Session
{
    //Подмешиваем трейт "Singleton".
    use TSingleton;

    /**
     * Конструктор класса. Выполняется в тот момент, когда мы создаём новый экземпляр.
     */
    public function __construct()
    {
        //Стартуем новую сессию.
        session_start();
    }

    /**
     * Метод получает значение из глобального массива $_SESSION.
     * @param string $key - Ключ.
     * @return mixed - Возвращает значение по ключу.
     */
    public function get($key) {
        return $_SESSION[$key];
    }

    /**
     * Метод добавляет значение в глобальный массив $_SESSION.
     * @param string $key - Ключ.
     * @param mixed $value - Значение.
     */
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }
}