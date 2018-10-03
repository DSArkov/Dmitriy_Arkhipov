<?php

//Подключаем скрипт.
require_once ENGINE_DIR . 'bd.php';

/**
 * Функция получает информацию о всех строках из БД.
 * @return array|null - Массив с данными из таблицы.
 */
function getAllProducts() {
    return queryAll('SELECT * FROM catalogue');
};

/**
 * Функция получает информацию о конкретной строке из БД.
 * @param string $id - id необходимой строки.
 * @return array|null - Массив с данными из таблицы.
 */
function getOneProductById($id) {
    return queryOne("SELECT * FROM catalogue WHERE id = {$id}");
}

/**
 * Функция получает название конкретного товара из БД.
 * @param string $id - id необходимой строки.
 * @return array|null - Массив с данными из таблицы.
 */
function getProdNameById($id) {
    return queryOne("SELECT title FROM catalogue WHERE id = {$id}");
}

/**
 * Функция получает стоимость конкретного товара из БД.
 * @param string $id - id необходимой строки.
 * @return array|null - Массив с данными из таблицы.
 */
function getProdPriceById($id) {
    return queryOne("SELECT price FROM catalogue WHERE id = {$id}");
}

/**
 * Функция получает url конкретного товара из БД.
 * @param string $id - id необходимой строки.
 * @return array|null - Массив с данными из таблицы.
 */
function getProdUrlById($id) {
    return queryOne("SELECT url FROM catalogue WHERE id = {$id}");
}

