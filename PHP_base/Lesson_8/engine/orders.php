<?php

function getOrder() {
    //Возвращаем результат выполнения запроса.
    return queryAll("SELECT id, date, total_cost, status FROM orders WHERE id_user = '{$_SESSION['users']['id']}'");
}

function addOrder() {
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
        //Приводим результат к числу.
        $lastInsertId = (int)$lastInsertId['id'];

        //Обходим в цикле все товары находящиеся в корзине.
        foreach ($order_products as $product => $value) {
            //Если это не последний элемент массива(в послуднем хранится общая стоимость).
            if ($product < count($order_products) - 1) {
                //Приводим стоимость к числу и сохраняем в переменную.
                $item_price = (int)$value['price'];
                //Добавляем товары в таблицу "order_items".
                query("INSERT INTO order_items (id_order, id_prod, item_price, quantity, login) 
                VALUES ('{$lastInsertId}', '{$value['id']}', '{$item_price}', '{$value['quantity']}', '{$_SESSION['users']['login']}')");
            }
        }

}