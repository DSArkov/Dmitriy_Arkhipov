<?php

//Регистрируем класс в пространстве имен "app\models".
namespace app\models;
//Назначаем псеводоним для "app\services\Db".
use app\services\Db as Db;

//Создаем абстрактный класс "Model", который реализует интерфейс "iModel".
 abstract class Model implements iModel
{
    //Создаем переменную, в которой будет находиться экземпляр класса "Db".
    private $db;

    /**
     * Конструктор класса. Выполняется в тот момент, когда мы создаём новый экземпляр.
     */
    public function __construct()
    {
        //Сохраняем объект в переменную $db.
        $this -> db = Db::getInstance();
    }

     /**
      * Функция делает запрос в БД по id продукта.
      * @param int $id - Идентификатор продукта.
      * @return array - Массив с результатами.
      */
    public function getOne($id) {
        //Получаем название таблицы из функции.
        $tableName = $this -> getTableName();
        //Сохраняем SQL-запрос в переменную.
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        //Обращемся в БД и возвращаем результат.
        return $this -> db -> queryOne($sql, ['id' => $id]);
    }

     /**
      * Функция делает запрос в БД для получения всех строк таблицы.
      * @return array - Массив с результатами.
      */
    public function getAll() {
        //Получаем название таблицы из функции.
        $tableName = $this -> getTableName();
        $className = $this -> getClassName();
        //Сохраняем SQL-запрос в переменную.
        $sql = "SELECT * FROM {$tableName}";
        //Обращемся в БД и возвращаем результат.
        return $this -> db -> queryAll($sql, $className);
    }
}