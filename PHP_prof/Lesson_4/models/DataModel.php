<?php

//Регистрируем класс в пространстве имен "app\models".
namespace app\models;

//Назначаем псеводоним для "app\services\Db".
use app\services\Db as Db;

//Создаем абстрактный класс "Model", который реализует интерфейс "iModel".
 abstract class DataModel implements IDataModel
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
      * @return array - Результат выполнения запроса.
      */
    public static function getOne($id) {
        //Получаем название таблицы из функции.
        $tableName = static::getTableName();
        //Сохраняем SQL-запрос в переменную.
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        //Обращемся в БД и возвращаем результат.
        return Db::getInstance() -> queryOne($sql, [':id' => $id]);
    }

     /**
      * Метод получает информацию о всех строках из БД.
      * @return array - Результат выполнения запроса.
      */
     public static function getAll() {
         //Получаем название таблицы из метода.
         $tableName = static::getTableName();
         //Сохраняем SQL-запрос в переменную.
         $sql = "SELECT * FROM {$tableName}";
         //Обращемся в БД и возвращаем результат.
         return Db::getInstance() -> queryAll($sql);
     }

     /**
      * Метод получает информацию о конкретной строке из БД.
      * @param string $id - идентификатор строки.
      * @return array - Результат выполнения запроса.
      */
     public static function getObject($id) {
         //Получаем название таблицы из функции.
         $tableName = static:: getTableName();
         //Сохраняем SQL-запрос в переменную.
         $sql = "SELECT * FROM {$tableName} WHERE id = :id";
         //Обращемся в БД и возвращаем результат.
         return Db::getInstance() -> queryObject($sql, [':id' => $id], get_called_class());
     }

     /**
      * Метод получает информацию о всех строках из БД.
      * @return array - Возвращает их в виде массива объектов текущего класса.
      */
     public static function getAllObjects() {
         //Получаем название таблицы из метода.
         $tableName = static:: getTableName();
         //Сохраняем SQL-запрос в переменную.
         $sql = "SELECT * FROM {$tableName}";
         //Обращемся в БД и возвращаем результат в виде массива объектов.
         return Db::getInstance() -> queryAllObjects($sql, get_called_class());
     }

     /**
      * Функция добавляет новые данные в БД.
      */
    public function insert() {
        //Получаем название таблицы из метода.
        $tableName = $this -> getTableName();
        //Создаём переменную для хранения массива с именами столбцов.
        $columns = [];
        //Создаём переменную для хранения массива с параметрами.
        $params = [];
        //Перебираем параметры текущего экземпляра класса.
        foreach ($this as $key => $value) {
            //TODO: Доделать фильтр.
            //Если значение имени параметра "id" - пропускаем его.
            if ($key == 'id') {
                continue;
            }
            //Если тип значения параметра "object" - пропускаем его.
            if (gettype($value) == 'object') {
                continue;
            }
            //Добавляем пару "Параметр - Значение" в массив "params".
            $params[":{$key}"] = "{$value}";
            //Добавляем имя параметра в массив "columns";
            $columns[] = "{$key}";
        }
        //Преобразуем массив в строку по разделителю.
        $columns = implode(', ', $columns);
        //Получаем массив с именами параметров и также преобразуем в строку.
        $placeholders = implode(', ', array_keys($params));
        //Сохраняем SQL-запрос в переменную.
        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";
        //Выполняем запрос к БД.
        $this -> db -> execute($sql, $params);
        //Получаем последний добавленный в базу id и сохраняем его в одноименный параметр.
        $this -> id = $this -> db -> lastInsertId();
    }

     /**
      * Функция обновляет данные текущего объекта в БД.
      */
     public function update() {
         //Получаем название таблицы из метода.
         $tableName = $this -> getTableName();
         //Создаём переменную для хранения массива пар "key = :key".
         $columns = [];
         //Создаём переменную для хранения массива с параметрами.
         $params = [];
         //Перебираем параметры текущего экземпляра класса.
         foreach ($this as $key => $value) {
             //TODO: Сделать так, чтобы обновлялись только измененные параметры.
             //Если значение параметра объект - пропускаем его.
             if (gettype($value) == 'object') {
                 continue;
             }
             //Добавляем пару "Параметр - Значение" в массив "params".
             $params["{$key}"] = "{$value}";
             //Добавляем пару "Ключ = :Ключ" в массив "columns".
             $columns[] = "{$key} = :{$key}";
         }
         //Преобразуем массив в строку по разделителю.
         $template = implode(', ', $columns);
         //Сохраняем запрос в переменную.
         $sql = "UPDATE {$tableName} SET {$template} WHERE id = {$this -> id}";
         //Выполняем его.
         $this -> db -> execute($sql, $params);
     }

     /**
      * Метод вызывет метод "Update", если продукт с заданным "id" уже есть в базе
      * и "Insert", если нет.
      */
     public function save() {
         //Проверяем текущее значение "id".
         if (!is_null($this -> id)) {
             $this -> update();
         } else {
             $this -> insert();
         }
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
         $this -> db -> execute($sql, [':id' => ($this -> id)]);
     }
}