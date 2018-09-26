<?php

/**
 * Функция устанавливает соединение с базой данных.
 * @param string $host - название или адрес хоста.
 * @param string $login - имя пользователя БД.
 * @param string $password - пароль для входа.
 * @param string $base - название базы.
 * @return object mysqli - идентификатор соединения.
 */
function connect($host, $login, $password, $base) {
    //Устанавливаем соединение.
    $conn = mysqli_connect($host, $login, $password, $base);
    //Если неудача - выводим сообщение об ошибке.
    if (mysqli_connect_errno()) {
        echo 'Не удалось соединиться с базой данных';
        exit;
    }
    return $conn;
}
