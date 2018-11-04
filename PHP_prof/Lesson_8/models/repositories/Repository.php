<?php

//Регистрируем класс в пространстве имен "app\models\repositories".
namespace app\models\repositories;

//Используем классы:
use app\base\App;
use app\models\DataEntity;


//Создаём класс репозиторий, основная задача которого сохранять и отдавать объекты.
abstract class Repository implements IRepository
{
    //Создаем переменную, в которой будет находиться экземпляр класса "Db".
    public $db;

    /**
     * Конструктор класса. Выполняется в тот момент, когда мы создаём новый экземпляр.
     */
    public function __construct()
    {
        //Сохраняем объект в переменную $db.
        $this -> db = static::getDb();
    }

    /**
     * Метод получает объект базы данных.
     * @return object - И возвращает его.
     */
    private static function getDb() {
        return App::call() -> db;
    }

    /**
     * Метод получает информацию о конкретной строке из БД.
     * @param string $id - идентификатор строки.
     * @return array - Результат выполнения запроса.
     */
    public function getOne($id) {
        //Получаем название таблицы из функции.
        $tableName = static::getTableName();
        //Сохраняем SQL-запрос в переменную.
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        //Обращемся в БД и возвращаем результат.
        return static::getDb() -> queryOne($sql, [':id' => $id]);
    }

    /**
     * Метод получает информацию о всех строках из БД.
     * @return array - Результат выполнения запроса.
     */
    public function getAll() {
        //Получаем название таблицы из метода.
        $tableName = static::getTableName();
        //Сохраняем SQL-запрос в переменную.
        $sql = "SELECT * FROM {$tableName}";
        //Обращемся в БД и возвращаем результат.
        return static::getDb() -> queryAll($sql);
    }

    /**
     * Метод получает информацию о конкретной строке из БД.
     * @param string $id - идентификатор строки.
     * @return array - Результат выполнения запроса.
     */
    public function getObject($id) {
        //Получаем название таблицы из функции.
        $tableName = static:: getTableName();
        //Сохраняем SQL-запрос в переменную.
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        //Обращемся в БД и возвращаем результат.
        return static::getDb() -> queryObject($sql, [':id' => $id], $this -> getEntityClass());
    }

    /**
     * Метод получает информацию о всех строках из БД.
     * @return array - Возвращает их в виде массива объектов текущего класса.
     */
    public function getAllObjects() {
        //Получаем название таблицы из метода.
        $tableName = static:: getTableName();
        //Сохраняем SQL-запрос в переменную.
        $sql = "SELECT * FROM {$tableName}";
        //Обращемся в БД и возвращаем результат в виде массива объектов.
        return static::getDb() -> queryAllObjects($sql, $this -> getEntityClass());
    }

    /**
     * Функция добавляет новые данные в БД.
     * @param DataEntity $entity - Наследник класса DataEntity.
     */
    public function insert(DataEntity $entity) {
        //Получаем название таблицы из метода.
        $tableName = $this -> getTableName();
        //Создаём переменную для хранения массива с именами столбцов.
        $columns = [];
        //Создаём переменную для хранения массива с параметрами.
        $params = [];
        //Перебираем параметры текущего экземпляра класса.
        foreach ($entity as $key => $value) {
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
     * @param DataEntity $entity - Наследник класса DataEntity.
     */
    public function update(DataEntity $entity) {
        //Получаем название таблицы из метода.
        $tableName = $entity -> getTableName();
        //Создаём переменную для хранения массива пар "key = :key".
        $columns = [];
        //Создаём переменную для хранения массива с параметрами.
        $params = [];
        //Перебираем параметры текущего экземпляра класса.
        foreach ($entity as $key => $value) {
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
        $sql = "UPDATE {$tableName} SET {$template} WHERE id = {$entity -> id}";
        //Выполняем его.
        $this -> db -> execute($sql, $params);
    }

    /**
     * Метод вызывет метод "Update", если продукт с заданным "id" уже есть в базе
     * и "Insert", если нет.
     * @param DataEntity $entity - Наследник класса DataEntity.
     */
    public function save(DataEntity $entity) {
        //Проверяем текущее значение "id".
        if (!is_null($entity -> id)) {
            $this -> update($entity);
        } else {
            $this -> insert($entity);
        }
    }

    /**
     * Метод удаляет строку из таблицы БД.
     * @param DataEntity $entity - Наследник класса DataEntity.
     */
    public function delete(DataEntity $entity) {
        //Получаем название таблицы из метода.
        $tableName = $this -> getTableName();
        //Сохраняем SQL-запрос в переменную.
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        //Делаем запрос в БД.
        $this -> db -> execute($sql, [':id' => ($entity -> id)]);
    }
}