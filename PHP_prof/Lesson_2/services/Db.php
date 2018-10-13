<?php

//Регистрируем класс в пространстве имен "app\services".
namespace app\services;

//Класс для работы с MySQL.
class Db implements iDb
{
    /**
     * Функция выбирает первую строку из результирующего набора и помещает её в массив.
     * @param string $sql - Текст запроса.
     * @return array - Возвращает массив с данными результирующей таблицы.
     */
    public function queryOne(string $sql) : array {
        return [];
    }

    /**
     * Функция выбирает все строки из результирующего набора и помещает их в массив.
     * @param string $sql - Текст запроса.
     * @return array - Возвращает массив с данными результирующей таблицы.
     */
    public function queryAll(string $sql) : array {
        return [];
    }

}