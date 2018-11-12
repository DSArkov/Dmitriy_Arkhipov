<?php

//Регистрируем класс в пространстве имен.
namespace app\services;


//Класс определяет методы для работы с сессией.
class Session
{
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
    public function get($key)
    {
        return $_SESSION[$key];
    }

    /**
     * Метод изменяет значение массива $_SESSION по заданному ключу.
     * @param array $keys - Массив из последовательности ключей, например: ['cart', '2', 'quantity']
     * @param mixed $value - Значение передаваемое в последний элемент ключей.
     */
    function set($keys, $value)
    {
        //Инициализируем пустой массив.
        $myArr = '';

        //Формируем строку массива в виде '['a']['b']['c']'.
        foreach ($keys as $item) {
            $myArr .= "['" . $item . "']";
        }

        //Формируем полную строку кода в виде '$_SESSION['a']['b']['c'] = value;'.
        $temp = '$_SESSION' . $myArr . ' = ' . "'" . $value . "'" . ';';

        //Выполняем код PHP, содержащейся в строке.
        eval($temp);
    }

    /**
     * Метод очищает текущую сессию.
     */
    public function delete()
    {
        session_destroy();
    }
}