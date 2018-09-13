<?php
header("Content-type: text/html; charset=utf-8");

//Задание 3.
/**
 * Функцуия выполняет сложение двух чисел.
 * @param int $a первое число.
 * @param int $b второе число.
 * @return float|int результат сложения.
 */
function sum(int $a, int $b) {
    return $a + $b;
}

/**
 * Функцуия выполняет вычитание двух чисел.
 * @param int $a первое число.
 * @param int $b второе число.
 * @return float|int результат вычитания.
 */
function subtraction(int $a, int $b) {
    return $a - $b;
}

/**
 * Функцуия выполняет умножение двух чисел.
 * @param int $a первое число.
 * @param int $b второе число.
 * @return float|int результат умножения.
 */
function multiply(int $a, int $b) {
    return $a * $b;
}

/**
 * Функцуия выполняет деление двух чисел.
 * @param int $a первое число.
 * @param int $b второе число.
 * @return float|int результат деления.
 */
function divide (int $a, int $b) {
    return $a / $b;
}

echo 'Сумма = ' . sum(1, 2) . '<br>';
echo 'Разность = ' . subtraction(1, 2) . '<br>';
echo 'Произведение = ' . multiply(1, 2) . '<br>';
echo 'Деление  = ' . divide(1, 2) . '<br>';



//Задание 4.
/**
 * Функция выполняет одну из четырех метематических операций в зависимости от вереданного параметра.
 * @param int $a первое число.
 * @param int $b второе число.
 * @param string $operator математический оператор.
 * @return float|int|string результат вычисления либо сообщение об ошибке.
 */
function mathMethods(int $a, int $b, string $operator) {
    switch ($operator) {
        case '+':
            return sum($a, $b);
            break;
        case '-':
            return subtraction($a, $b);
            break;
        case '*':
            return multiply($a, $b);
            break;
        case '/':
            return divide($a, $b);
            break;
        default:
            echo "Можно использовать только операции '+', '-', '*', '/'.";
    }
}

echo '<br>' . mathMethods(1, 2, '+') . '<br>';
echo mathMethods(1, 2, '--') . '<br>';