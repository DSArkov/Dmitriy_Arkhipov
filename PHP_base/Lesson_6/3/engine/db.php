<?php

/**
 * Функция выполняет подключение к базе данных.
 * @return object - Возвращает объект, представляющий подключение к серверу MySQL.
 */
function getConnection() {
    //Сохраняем в переменную массив данных для подключения к MySQL.
    $config = include CONFIG_DIR . 'db.php';
    //Cоздаём переменную для хранения текущего состояния.
    static $isConnection = NULL;
    //Проверяем было ли оно установлено ранее.
    if (is_null($isConnection)) {
    //Если нет, то подключаемся.
    $conn = mysqli_connect($config['host'], $config['user'], $config['password'], $config['dbName']);
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
function query($sql) {
    //Сохраняем данные в массив.
    return mysqli_fetch_all(execute($sql), MYSQLI_ASSOC);
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
 * Функция экранирует специальные символы в строке для использования в SQL выражении,
 * используя текущий набор символов соединения.
 * @param string $str - Строка, которую необходимо экранировать.
 * @return string - Возвращает обработанную строку.
 */
function shieldingStr($str) {
    //Экранируем специальные символы.
    return mysqli_real_escape_string(getConnection(), $str);
}