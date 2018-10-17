<?php

//Регистрируем класс в пространстве имен "app\services".
namespace app\services;

//Класс для работы с MySQL(паттерн "Одиночка").
class Db
{
    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'little_shop',
        'charset' => 'utf8'
    ];

    protected $conn = null;

    //Создаем защищенное статическое свойство для хранения единственного экземпляра Db.
    protected static $instance = null;

    //Запрещаем создание объекта.
    private function __construct() {}
    //Запрещаем клонирование объекта.
    private function __clone() {}
    //Запрещаем восстановление объекта из серриализованных данных.
    private function __wakeup() {}

    public static function getInstance() {
        //Проверяем пустое ли статическое свойство $instance.
        if (is_null(static::$instance)) {
            //Создаём новый экземпляр текущего класса.
            //static использует позднее статическое связывание.
            static::$instance = new static();
        }
        //Если такой объект уже создан, то возвращаем его.
        return static::$instance;
    }

    protected function getConnection() {
        if (is_null($this -> conn)) {
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
     * Метод выбирает первую строку из результирующего набора и помещает её в массив.
     * @param string $sql - Текст запроса.
     * @param array $params - Параметры.
     * @return array - Возвращает данные необходимой строки.
     */
    public function queryOne(string $sql, array $params = []) {
        //Вызываем метод, который выполняет запрос и возвращаем первый элемент.
        return $this -> queryAll($sql, $params)[0];
    }

    /**
     * Метод выбирает все строки из результирующего набора и помещает их в массив.
     * @param string $sql - Текст запроса.
     * @param array $params - Параметры.
     * @return array - Возвращает массив, содержащий все строки результирующего набора.
     */
    public function queryAll(string $sql, array $params = []) : array {
        //Вызываем метод, который выполняет запрос и возвращаем массив с результатами.
        return $this -> query($sql, $params) -> fetchAll();
    }

    /**
     * Метод делает запрос в базу данных.
     * @param string $sql - Текст запроса.
     * @param $params - Параметры.
     */
    private function execute(string $sql, array $params = []) {
        //Вызываем метод "query", который выполняет запрос в БД.
        $this -> query($sql, $params);
    }

    private function prepareDsnString():string {
        //"mysql:host=$host; dbname=$db; charset=$charset";
        return sprintf('%s:host=%s; dbname=%s; charset=%s',
        $this -> config['driver'],
        $this -> config['host'],
        $this -> config['database'],
        $this -> config['charset']);
    }
}