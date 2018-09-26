<?php

/**
 * Функция получает информацию о конкретном изображении по id.
 * @param int $id - id необходимой картинки.
 * @return array|null - ассоциативный массив с данными.
 */
function getImg($id) {
    //Создаем SQL запрос.
    $res = query("SELECT url, title, count FROM big_small_img.images WHERE id = '{$id}'");
    //Извлекаем данные из результата и возвращаем их.
    return mysqli_fetch_assoc($res);
}