<?php
header("Content-type: text/html; charset=utf-8");

/**
 * Функция выбирает правильное склонение слова из массива отталкиваясь от числового значения.
 * @param array $arr массив со словами.
 * @param int $num передаваемое число.
 * @return string возвращает строку с результатом.
 */
function timeFormat($arr, $num) {
    //Получаем последгюю цифру.
    $numLast = (int)substr($num, -1);
    //Получаем предпоследнюю цифру.
    $numPreLast = (int)substr($num, -2, 1);

    //Проверяем значения.
    if (($numLast == 1) && ($numPreLast != 1)) {
        $result = $num . ' ' . $arr[0];
    } else if (($numLast >= 2) && ($numLast <= 4) && ($numPreLast != 1)) {
        $result = $num . ' ' . $arr[1];
    } else {
        $result = $num . ' ' .  $arr[2];
    }
    return $result;
}

$arrHours = ['час', 'часа', 'часов'];
$arrMinutes = ['минута', 'минуты', 'минут'];
$hoursNow = date(H);
$minutesNow = date(i);

echo timeFormat($arrHours, $hoursNow) . ' : ' . timeFormat($arrMinutes, $minutesNow);