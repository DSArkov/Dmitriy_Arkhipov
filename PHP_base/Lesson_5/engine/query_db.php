<?php

/**
 * Функция выполняет запрос к базе данных.
 * @param string $query - текст запроса.
 * @return bool|mysqli_result - если запрос успешен, вернёт объект результатов.
 * Иначе false и выведет ошибку.
 */
function query($query) {
    //Проверяем установлено ли соединение.
    if (!isset($GLOBALS['_db_connect'])) {
        //Если нет - подключаемся.
        $GLOBALS['_db_connect'] = connect(HOST, LOGIN, PASSWORD, TITLE);
    }
    //В случае ошибки выводим сообщение.
    if (!$res = mysqli_query($GLOBALS['_db_connect'], $query)) {
        echo "Ошибка запроса.";
        exit;
    }
    return $res;
}