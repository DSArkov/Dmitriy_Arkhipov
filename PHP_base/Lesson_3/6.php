<?php
header("Content-type: text/html; charset=utf-8");

/**
 * Функция генерирует многоуровневое меню.
 */
function menu() {
    //Массив с пунктами и подпунктами.
    $arrMenu = ['Главная' => ['Пункт 1', 'Пункт 2', 'Пункт 3'],
        'Каталог' => ['Пункт 1', 'Пункт 2', 'Пункт 3'],
        'Галерея' => ['Пункт 1', 'Пункт 2', 'Пункт 3'],
        'Отзывы' => ['Пункт 1', 'Пункт 2', 'Пункт 3'],
        'Контакты'];

    echo '<ul>';
    //Перебираем ключи со значениями и формирем меню.
    foreach ($arrMenu as $key => $value) {
        //Если пункт содержит подменю,
        if (is_string($key)) {
            echo '<li>' . $key . '<ul>';
            //то проходим по вложенному массиву и отображаем меню на странице.
            for ($i = 0; $i < count($value); $i++) {
                echo '<li>' . $value[$i] . '</li>';
            }
            echo '</ul>';
            //Если не содержит подменю - просто выводим на экран.
        } else {
            echo '<li>' . $value . '</li>';
        }
    }
};

//Вызываем функцию.
menu();

