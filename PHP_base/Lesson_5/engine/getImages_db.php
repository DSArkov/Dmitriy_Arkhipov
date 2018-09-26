<?php

/**
 * Функция получает данные изображений из базы.
 * @return array|null - ассоциативный массив.
 */
function getImages() {
    //Создаем запрос и сохраняем его в переменную.
    $res = query('SELECT * FROM big_small_img.images ORDER BY count DESC');
    //Выбираем все строки из результирующего набора, помещаем их в массив и возвращаем.
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}