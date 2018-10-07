<?php

/**
 * Функция делает запрос на получение данных из БД по заданному id.
 * @return array|null - Возвращает массив результатов.
 */
function getOrder() {
    //Возвращаем результат выполнения запроса.
    return queryAll("SELECT id, date, total_cost, status FROM orders WHERE id_user = '{$_SESSION['users']['id']}'");
}

/**
 * Функция делает запрос на добавление данных в MySQL.
 */
function addOrder() {
    //Проверяем существование массива "cart" в текущей сессии.
    if ($_SESSION['cart']){
        //Получаем все товары из корзины.
        $order_products = getCartProd($_SESSION['cart']);
        //Получаем общую стоимость товаров.
        $total_cost = ($order_products[count($order_products) - 1]['total']);
        //Сохраняем в переменную текущее время.
        $datetime = time();
        //Делаем запрос на добавление заказа в таблицу "orders".
        query("INSERT INTO orders (id_user, date, total_cost) 
        VALUES ('{$_SESSION['users']['id']}', '{$datetime}', '{$total_cost}')");
        //Получаем последний добавленный id.
        $lastInsertId = queryOne("SELECT MAX(`id`) AS id FROM `orders`");

        //Обходим в цикле все товары из корзины.
        foreach ($order_products as $product => $value) {
            //Если это не последний элемент массива(в послуднем хранится общая стоимость).
            if ($product < count($order_products) - 1) {
                //Добавляем товары в таблицу "order_items".
                query("INSERT INTO order_items (id_order, id_prod, item_price, quantity, login) 
              VALUES ('{$lastInsertId['id']}', '{$value['id']}', '{$value['price']}', '{$value['quantity']}', '{$_SESSION['users']['login']}')");
            }
        }
        //Очищаем корзину.
        $_SESSION['cart'] = [];
        //Делаем редирект на текущую страницу.
        redirect($_SERVER['REQUEST_URI']);
        //Прекращаем выполнение текущего скрипта.
        exit;
    }
}

/**
 * Функция делаект запрос к БД для изменения статуса заказа по id.
 * @param string $id_order - id заказа.
 */
function changeStatus($id_order) {
    //Меняем статус заказа.
    query("UPDATE orders SET status = 'Отменен' WHERE id = '{$id_order}'");
}