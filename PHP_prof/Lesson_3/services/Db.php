<?php

//Регистрируем класс в пространстве имен "app\services".
namespace app\services;

//Назначаем псеводоним для "app\traits\TSingleton".
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
        $this -> conn -> setAttribute(\PDO::FETCH_CLASS, \PDO::FETCH_ASSOC);
    }
    //Возвращаем соединение.
    return $this -> conn;
    }

    /**
     * Универсальный метод, который выполняет SQL-запросы.
     * @param string $sql - Текст запроса.
     * @param array $params - Параметры.
     * @return boolean - Результат.
     */
    public function query(string $sql, array $params = []) {
        //Создаём объект PDO, который содержит в себе подготовленный запрос, защищенный от SQL инъекций.
        //Теперь, меняя параметры, мы можем вызывать его столько раз, сколько нам потребуется.
        $pdoStatement = $this -> getConnection() -> prepare($sql);

        //1-й способ) Проверяем тип и привязываем параметр "id".
        //$pdoStatement -> bindParam(':id', $id, \PDO::PARAM_INT);

        //2-й способ) Выполняем запрос(INSERT, UPDATE, DELETE), передавая параметры.
        //В данном случае привязка произойдёт автоматически. Пр.массива $param: [':id' => 1].
        $pdoStatement -> execute($params);
        //Возвращает TRUE в случае успешного завершения или FALSE в случае возникновения ошибки.
        return $pdoStatement;
    }

    /**
     * Метод выбирает первую строку из результирующего набора.
     * @param string $sql - Текст запроса.
     * @param string $class - Имя текущего класса.
     * @param array $params - Параметры.
     * @return object - Возвращает необходимую строку из таблицы, присваивая значения столбцов
     * результирующего набора именованным свойствам текущего класса.
     */
    public function queryOne(string $sql, $class, array $params = []) {
        //Вызываем метод, который выполняет запрос и возвращаем результат.
        return $this -> query($sql, $params) -> fetchAll(\PDO::FETCH_CLASS, $class)[0];
    }

    /**
     * Метод выбирает все строки из результирующего набора.
     * @param string $sql - Текст запроса.
     * @param string $class - Имя текущего класса.
     * @param array $params - Параметры.
     * @return object - Возвращает все строки из таблицы, присваивая значения столбцов
     * результирующего набора именованным свойствам текущего класса.
     */
    public function queryAll(string $sql, $class, array $params = []) : array {
        //Вызываем метод, который выполняет запрос и возвращаем результат.
        return $this -> query($sql, $params) -> fetchAll(\PDO::FETCH_CLASS, $class);
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
}