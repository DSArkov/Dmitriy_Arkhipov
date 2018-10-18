<?php

//Регистрируем класс в пространстве имен "app\models".
namespace app\models;

//Создаем интерфейс, который указывает, какие методы должен реализовать класс "Model".
interface iModel
{
    /**
     * Метод возвращает название таблицы БД, к которой будем обращаться.
     * @return string - Название таблицы.
     */
    public function getTableName();

    /**
     * Метод получает информацию о конкретной строке из БД.
     * @param string $id - идентификатор строки.
     * @return object - Результат выполнения запроса.
     */
    public function getOne($id);

    /**
     * Метод получает информацию о всех строках из БД.
     * @return object - Результат выполнения запроса.
     */
    public function getAll();

    /**
     * Метод добавляет новую строку в таблицу БД.
     */
    public function insert();

    /**
     * Метод изменяет данные в таблице БД.
     */
    public function update();

    /**
     * Метод удаляет строку из таблицы БД.
     */
    public function delete();
}