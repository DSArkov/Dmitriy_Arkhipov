<?php

/**
 * Функция проверяет наличие продукта с определенным id в массиве $_SESSION. Если
 * таковой отсутствует - добавляет его и считает количество.
 * @param string $id - id продукта.
 * @param int $quantity - Количество единиц товара(по умолчанию = 1).
 */
function addToCart($id, $quantity = 1) {
    //Проверяем наличие id в $_SESSION.
    if (isset($_SESSION['cart'][$id])) {
        //Если есть, то увеличиваем количество на 1.
        $_SESSION['cart'][$id]['quantity'] += $quantity;
    } else {
        //Если нет - добавляем и присвоем количество равное единице.
        $_SESSION['cart'][$id]['quantity'] = $quantity;
    }
}

/**
 * Функция уменьшает количество товара в корзине, либо удаляет товар полностью,
 * если он в единичном экземпляре.
 * @param string $id - id продукта.
 * @param int $quantity - Количество единиц товара(по умолчанию = 1).
 */
function deleteFromCart($id, $quantity = 1) {
    //Если количество товара равно 1.
    if ($_SESSION['cart'][$id]['quantity'] = 1) {
        //Удаляем данный продукт из массива.
        unset($_SESSION['cart'][$id]);
    } else {
        //Иначе уменьшаем количество на 1.
        $_SESSION['cart'][$id]['quantity'] -= $quantity;
    }
}

