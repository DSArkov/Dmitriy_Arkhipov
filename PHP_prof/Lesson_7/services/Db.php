<?php

//Регистрируем класс в пространстве имен "app\services".
namespace app\services;

//Используем класс:
use app\traits\TSingleton;


//Класс для работы с базой данных.
class Db
{
    //Подмешиваем трейт "Singleton".
    use TSingleton;

    //Создаём переменную для хранения настроек подключения к БД.
    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'login' => 'root',
        'password' => 'root',
        'database' => 'little_shop',
        'charset' => 'utf8',
        'port' => 3307
    ];

    //Создаём переменную для хранения текущего состояния соединения с БД.
    protected $conn = null;

    /**
     * Метод подготавливает данные для последующего соединения с БД.
     * @return string - Возвращает отформатированную строку.
     */
    private function prepareDsnString():string {
        //Подставляем необходимые значения и возвращем строку.
        return sprintf('%s:host=%s; dbname=%s; charset=%s; port=%s',
            $this -> config['driver'],
            $this -> config['host'],
            $this -> config['database'],
            $this -> config['charset'],
            $this -> config['port']);
    }

    /**
     * Метод устанавливает соединения с базой данных.
     * @return null|\PDO - Возвращает объект подключения к БД.
     */
    protected function getConnection() {
        //Проверяем, было ли ранее установлено соединение.
        if (is_null($this -> conn)) {
            //Если нет, то создаём новый объект соединения с БД, передавая необходимые параметры.
            $this -> conn = new \PDO(
                $this -> prepareDsnString(),
                $this -> config['login'],
                $this -> config['password']
            );
        //Устанавливаем объекту PDO атрибут "Режим выборки данных по умолчанию" со значением "Ассоциативный массив".
        $this -> conn -> setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }
    //Возвращаем соединение.
    return $this -> conn;
    }

    /**
     * Универсальный метод, который выполняет SQL-запросы.
     * @param string $sql - Текст запроса.
     * @param array $params - Параметры.
     * @return string - Возвращает результат выполнения запроса.
     */
    public function query(string $sql, array $params = []) {
        //Создаём объект PDO, который содержит в себе подготовленный запрос, защищенный от SQL инъекций.
        //Теперь, меняя параметры, мы можем вызывать его столько раз, сколько нам потребуется.
        $pdoStatement = $this -> getConnection() -> prepare($sql);

        //1-й способ) Проверяем тип и привязываем параметр "id".
        //$pdoStatement -> bindParam(':id', $id, \PDO::PARAM_INT);

        //2-й способ) Выполняем запрос передавая параметры. В данном случае привязка произойдёт автоматически.
        //Пр.массива $param: [':id' => 1].
        $pdoStatement -> execute($params);
        //Возвращаем результат выполнения запроса.
        return $pdoStatement;
    }

    /**
     * Метод выбирает первую строку из результирующего набора.
     * @param string $sql - Текст запроса.
     * @param array $params - Параметры.
     * @return array - Возвращает данные необходимой строки из таблицы.
     */
    public function queryOne(string $sql, array $params = []) {
        //Вызываем метод, который выполняет запрос и возвращаем результат.
        return $this -> queryAll($sql, $params)[0];
    }

    /**
     * Метод выбирает первую строку из результирующего набора.
     * @param string $sql - Текст запроса.
     * @param array $params - Параметры.
     * @param string $className - Имя текущего класса.
     * @return object - Возвращает результат в виде объекта запрошенного класса.
     */
    public function queryObject(string $sql, array $params = [], string $className) {
        //Вызываем функцию, которая делает запрос в БД.
        $smtp = $this -> query($sql, $params);
        //Устанавливаем режим выборки "Создать и вернуть бъект запрошенного класса".
        $smtp -> setFetchMode(\PDO::FETCH_CLASS, $className);
        //Извлекаем и возвращаем строку из результирующего набора в виде объекта.
        return $smtp -> fetch();
    }

    /**
     * Метод выбирает все строки из результирующего набора.
     * @param string $sql - Текст запроса.
     * @param array $params - Параметры.
     * @return array - Возвращает массив, содержащий все строки результирующего набора.
     */
    public function queryAll(string $sql, array $params = []) : array {
        //Вызываем метод, который выполняет запрос и возвращаем результат.
        return $this -> query($sql, $params) -> fetchAll();
    }

    /**
     * Метод выбирает все строки из результирующего набора.
     * @param string $sql - Текст запроса.
     * @param string $className - Имя текущего класса.
     * @param array $params - Параметры.
     * @return array - Возвращает мессив объектов запрошенного класса.
     */
    public function queryAllObjects(string $sql, string $className, array $params = []) {
        //Вызываем функцию, которая делает запрос в БД.
        $smtp = $this -> query($sql, $params);
        //Устанавливаем режим выборки "Создать и вернуть бъект запрошенного класса".
        $smtp -> setFetchMode(\PDO::FETCH_CLASS, $className);
        //Извлекаем и возвращаем строку из результирующего набора в виде массива объектов.
        return $smtp -> fetchAll();
    }

    /**
     * Метод делает запрос в базу данных.
     * @param string $sql - Текст запроса.
     * @param $params - Параметры.
     */
    public function execute(string $sql, array $params = []) {
        //Вызываем метод "query", который выполняет запрос в БД.
        $this -> query($sql, $params);
    }

    /**
     * Метод возвращает "id" последней вставленной строки или значение последовательности.
     * @return string - "id" последней вставленной строки в БД.
     */
    public function lastInsertId() {
        //Устанавливаем соединение с БД и возвращаем последний добавленный "id".
        return $this -> getConnection() -> lastInsertId();
    }
}