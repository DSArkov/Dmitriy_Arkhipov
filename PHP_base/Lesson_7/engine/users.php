<?php

//Подключаем скрипт.
require_once ENGINE_DIR . 'bd.php';


/**
 * Функция делает запрос в БД для получения данных о пользователе.
 * @param string $login - Логин пользователя.
 * @param string $password - Пароль пользователя.
 * @return array|null - Возвращает массив с данными.
 */
function getUserByLoginPass($login, $password) {
    return queryOne("SELECT * FROM users WHERE login = '{$login}' AND password = '{$password}'");
}