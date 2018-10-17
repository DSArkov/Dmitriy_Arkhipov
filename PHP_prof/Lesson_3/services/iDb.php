<?php

//Регистрируем класс в пространстве имен "app\services".
namespace app\services;

//Создаем интерфейс, который указывает, какие методы должен реализовать класс "Db".
interface iDb
{
    /**
     * Функция выбирает первую строку из результирующего набора и помещает её в массив.
     * @param string $sql - Текст запроса.
     * @return array - Возвращает массив с данными результирующей таблицы.
     */
    public function queryOne(string $sql, array $params = []);

    /**
     * Функция выбирает все строки из результирующего набора и помещает их в массив.
     * @param string $sql - Текст запроса.
     * @return array - Возвращает массив с данными результирующей таблицы.
     */
    public function queryAll(string $sql, array $params = []) : array;
}