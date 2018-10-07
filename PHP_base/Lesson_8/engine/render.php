<?php

/**
 * Функция отрисовывает шаблон с передаваемыми параметрами.
 * @param string $template - имя шаблона.
 * @param array $params - параметры.
 */
function render($template, $params = []) {
    //Импортируем переменные из массива в текущую таблицу символов.
    extract($params);
    //Подключаем необходимый шаблон.
    include TEMPLATES_DIR . "{$template}.php";
}