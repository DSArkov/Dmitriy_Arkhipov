<?php

//Регистрируем класс в пространстве имен "app\models".
namespace app\models;
//Назначаем псеводоним для "app\services\iDb".
use app\services\iDb as iDb;

//Создаем абстрактный класс "Model", который реализует интерфейс "iModel".
 abstract class Model implements iModel
{
    //Создаем переменную, в которой будет находиться экземпляр класса "Db".
    private $db;

    /**
     * Конструктор класса. Выполняется в тот момент, когда мы создаём новый экземпляр.
     * @param iDb $db - Экземпляр класса "iDb".
     */
    public function __construct(iDb $db)
    {
        //Сохраняем объект в переменную $db.
        $this -> db = $db;
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
        $sql = "SELECT * FROM {$tableName} WHERE id = {$id}";
        //Обращемся в БД и возвращаем результат.
        return $this -> db -> queryOne($sql);
    }

     /**
      * Функция делает запрос в БД для получения всех строк таблицы.
      * @return array - Массив с результатами.
      */
    public function getAll() {
        //Получаем название таблицы из функции.
        $tableName = $this -> getTableName();
        //Сохраняем SQL-запрос в переменную.
        $sql = "SELECT * FROM {$tableName}";
        //Обращемся в БД и возвращаем результат.
        return $this -> db -> queryAll($sql);
    }
}