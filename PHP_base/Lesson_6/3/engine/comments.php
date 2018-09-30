<?php

/**
 * Функция выполняет запрос к базе данных.
 * @return array|null - Возвращает массив с результатами или NULL в случае неудачи.
 */
function getComments() {
    //Выполняем запрос и возвращаем результат.
    return query('SELECT * FROM comments');
}

/**
 * Функция выполняет запрос на добавление данных в БД.
 * @param string $name - Имя введенное пользователем.
 * @param string $comment - Комментарий введенный пользователем.
 */
function addComment($name, $comment) {
    //Отправляем запрос.
    execute("INSERT INTO comments (name, text) VALUES ('{$name}', '{$comment}')");
}