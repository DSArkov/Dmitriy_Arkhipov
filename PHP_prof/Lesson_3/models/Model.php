<?php

//Регистрируем класс в пространстве имен "app\models".
namespace app\models;
//Назначаем псеводоним для "app\services\Db".
use app\services\Db as Db;

//Создаем абстрактный класс "Model", который реализует интерфейс "iModel".
 abstract class Model implements iModel
{
    //Создаем переменную, в которой будет находиться экземпляр класса "Db".
    public $db;

    /**
     * Конструктор класса. Выполняется в тот момент, когда мы создаём новый экземпляр.
     */
    public function __construct()
    {
        //Сохраняем объект в переменную $db.
        $this -> db = Db::getInstance();
    }

     /**
      * Метод получает информацию о конкретной строке из БД.
      * @param string $id - идентификатор строки.
      * @return object - Результат выполнения запроса.
      */
    public function getOne($id) {
        //Получаем название таблицы из функции.
        $tableName = $this -> getTableName();
        //Сохраняем SQL-запрос в переменную.
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        //Обращемся в БД и возвращаем результат.
        return $this -> db -> queryOne($sql, [':id' => $id]);
    }

     /**
      * Метод получает информацию о всех строках из БД.
      * @return object - Результат выполнения запроса.
      */
    public function getAll() {
        //Получаем название таблицы из метода.
        $tableName = $this -> getTableName();
        //Сохраняем SQL-запрос в переменную.
        $sql = "SELECT * FROM {$tableName}";
        //Обращемся в БД и возвращаем результат.
        return $this -> db -> queryAll($sql, $this -> className);
    }

     /**
      * Метод удаляет строку из таблицы БД.
      */
    public function delete() {
        //Получаем название таблицы из метода.
        $tableName = $this -> getTableName();
        //Сохраняем SQL-запрос в переменную.
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        //Делаем запрос в БД.
        $this -> db -> execute($sql, [':id' => $this -> id]);
    }
}