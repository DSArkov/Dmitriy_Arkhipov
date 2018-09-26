<?php

/**
 * Функция увеличивает счетчик на 1.
 * @param int $id - идентификатор изображения.
 * @param int $count - текущее значение счетчика просмотров.
 */
function increaseCount($id, $count) {
    //Увеличиваем счетчик на единицу.
    $count += 1;
    //Создаем SQL запрос.
    query("UPDATE big_small_img.images SET count = '{$count}' WHERE id = '{$id}'");

}