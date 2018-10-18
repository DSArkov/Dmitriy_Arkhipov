<?php

//Регистрируем класс в пространстве имен "app\models".
namespace app\models;

//Создаем интерфейс, который указывает, какие методы должен реализовать класс "Model".
interface iModel
{
    /**
     * Функция возвращает название таблицы БД, к которой будем обращаться.
     * @return string - Название таблицы.
     */
    public function getTableName();

    public function getClassName();
    /**
     * Функция получает информацию о конкретной строке из БД.
     * @param string $id - идентификатор строки.
     * @return array - Массив с данными из таблицы.
     */
    public function getOne($id);

    /**
     * Функция получает информацию о всех строках из БД.
     * @return array - Массив с данными из таблицы.
     */
    public function getAll();

    public function create();

    public function update();

    public function delete();
}