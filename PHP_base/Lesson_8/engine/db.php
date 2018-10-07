<?php

/**
 * Функция выполняет подключение к базе данных.
 * @return object - Возвращает объект, предоставляющий подключение к серверу MySQL.
 */
function getConnection() {
    //Сохраняем в переменную массив данных для подключения к MySQL.
    $config = include CONFIG_DIR . 'db.php';
    //Cоздаём статическую переменную для хранения текущего состояния.
    static $isConnection = NULL;
    //Проверяем было ли ранее установлено соединение.
    if (is_null($isConnection)) {
        //Если нет, то подключаемся.
        $conn = mysqli_connect($config['host'], $config['login'], $config['password'], $config['dbName']);
        //Возвращаем объект с данными.
        return $conn;
    }
}

/**
 * Функция выполняет запрос к базе данных.
 * @param string $sql - Текст запроса.
 * @return bool|mysqli_result - В случае успешного выполнения запросов SELECT, SHOW, DESCRIBE
 * или EXPLAIN mysqli_query() вернет объект mysqli_result. Иначе FALSE.
 */
function execute($sql) {
    //Выполняем запрос к БД и возвращаем объект результатов.
    return mysqli_query(getConnection(), $sql);
}

/**
 * Функция выбирает все строки из результирующего набора и помещает их в массив.
 * @param $sql - Текст запроса.
 * @return array|null - Возвращает массив с данными результирующей таблицы.
 */
function queryAll($sql) {
    //Сохраняем данные в массив и возвращаем результат.
    return mysqli_fetch_all(execute($sql), MYSQLI_ASSOC);
}

/**
 * Функция выбирает первую строку из результирующего набора и помещает её в массив.
 * @param $sql - Текст запроса.
 * @return array|null - Возвращает массив с данными результирующей таблицы.
 */
function queryOne($sql) {
    //Сохраняем данные в массив и возвращаем результат.
    return queryAll($sql)[0];
}

/**
 * Функция закрывает открытое ранее соединение с базой данных.
 * @return bool - Возвращает TRUE в случае успешного завершения или FALSE в случае возникновения ошибки.
 */
function closeConnection() {
    //Закрываем соединение.
    return mysqli_close(getConnection());
}
/**
 * Функция выбирает первую строку из результирующего набора и помещает её в массив.
 * @param $sql - Текст запроса.
 * @return bool|mysqli_result - В случае успешного выполнения запросов SELECT, SHOW, DESCRIBE
 * или EXPLAIN mysqli_query() вернет объект mysqli_result. Иначе FALSE.
 */
function query($sql) {
    //Сохраняем данные в массив и возвращаем результат.
    return mysqli_query(getConnection(), $sql);
}