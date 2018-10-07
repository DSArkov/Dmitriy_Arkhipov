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
    if ($_SESSION['cart'][$id]['quantity'] == 1) {
        //Удаляем данный продукт из массива.
        unset($_SESSION['cart'][$id]);
    } else {
        //Иначе уменьшаем количество на 1.
        $_SESSION['cart'][$id]['quantity'] -= $quantity;
    }
}

/**
 * Функция формирует массив с данными о товарах, которые были добавлены в корзину.
 * @param array $arr - Массив добавленных товаров.
 * @return array - Сформированный массив с необходимой информацией.
 */
function getCartProd($arr = []) {
    //Инициализируем пустой массив.
    $arrProd = [];
    //Инициализируем перенную для хранения общей стоимости товаров.
    $totalProdCost = 0;
    //Проверяем передали ли мы существующий массив.
    if (isset($arr)) {
        //Если да, то перебираем его.
        foreach ($arr as $key => $value) {
            //Получаем значение id для продукта.
            $prod_id = $key;
            //Получаем данные продукта из функции, которая делает запрос в БД.
            $prod = getOneProductById($prod_id);
            //Получаем количество единиц товара, который добавили.
            $prod_quantity = $value['quantity'];
            //Считаем общую стоимость товара.
            $totalPrice = (int)$prod['price']  * $prod_quantity;
            //Прибавляем её к общей стимости всех товаров.
            $totalProdCost += $totalPrice;
            //Добавляем данные в массив.
            $arrProd[] = ['id' => $prod_id, 'url' => $prod['url'], 'title' => $prod['title'], 'price' => $prod['price'],
                'quantity' => $prod_quantity, 'cost' => $totalPrice];
        }
        //Добавляем в массив общую стоимость всех товаров.
        $arrProd[] = ['total' => $totalProdCost];
    }
    //Возвращаем массив с данными о товарах.
    return $arrProd;
}