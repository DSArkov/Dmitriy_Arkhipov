<?php
header("Content-type: text/html; charset=utf-8");

/**
 * Функция возводит число в степень.
 * @param int $val операнд.
 * @param int $pow степень.
 * @return bool|float|int возвращает результат либо false и выводит сообщение об ошибке.
 */
function power(int $val, int $pow) {
    if ($pow < 0) {
        echo 'Степень должна быть больше нуля.';
        return false;
    } else if ($pow == 1) {
        return $val;
    } else {
        return $val * power($val, $pow - 1);
    }
}

echo power(5, -1) . '<br>';
echo power(5, 2) . '<br>';
echo power(-1, 2) . '<br>';