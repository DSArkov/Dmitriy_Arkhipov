<?php

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