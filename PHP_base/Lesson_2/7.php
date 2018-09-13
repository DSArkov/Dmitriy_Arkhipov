<?php
header("Content-type: text/html; charset=utf-8");

/**
 * Функция правильно склоняет слово 'час' в зависимости от текущего времени.
 * @return string возвращет строку с результатом.
 */
function hoursFormat() {
    $hours = date(G);
    $subHours = (int)substr($hours, -1);

    if ($subHours == 1) {
        $left = $hours . ' час';
    } else if (($subHours >= 2) && ($subHours <= 4)) {
        $left = $hours . ' часа';
    } else {
        $left = $hours . ' часов';
    }
    return $left;
}

/**
 * Функция правильно склоняет слово 'минута' в зависимости от текущего времени.
 * @return string возвращет строку с результатом.
 */
function minutesFormat() {
    $minutes = date(i);
    $subMinutes = (int)substr($minutes, -1);

    if ($subMinutes == 1) {
        $right = $minutes . ' минута';
    } else if (($subMinutes >= 2) && ($subMinutes <= 4)) {
        $right = $minutes . ' минуты';
    } else {
        $right = $minutes . ' минут';
    }
    return $right;
}

/**
 * Функция получает результат двух функций и склеивает полученные значения в одну строку.
 * @return string возвращет строку с результатом.
 */
function timeFormat() {
    return hoursFormat() . ' : ' . minutesFormat();
}

echo timeFormat();