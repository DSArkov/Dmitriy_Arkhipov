<?php
header("Content-type: text/html; charset=utf-8");

/**
 * Функция находит проблелы и заменяет их знаком "_".
 * @param string $str передаваемая строка.
 * @return string возвращает модифицированную строку.
 */
function replace($str) {
    return str_replace(' ', '_', $str);
}

echo replace('У меня когда-то были пробелы между слов.');