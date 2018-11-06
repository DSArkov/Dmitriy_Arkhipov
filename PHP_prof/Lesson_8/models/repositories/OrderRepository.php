<?php

//Регистрируем класс в пространстве имен "app\models\repositories".
namespace app\models\repositories;

//Используем класс "Order".
use app\base\App;
use app\models\Cart;
use app\models\Order;


//Класс-хранилище для заказов.
class OrderRepository extends Repository
{
    /**
     * Метод возвращает название таблицы БД, к которой будем обращаться.
     * @return string - Название таблицы.
     */
    public function getTableName() {
        return 'orders';
    }

    /**
     * Метод возвращает имя класса "Order".
     * @return string - Имя класса.
     */
    public function getEntityClass() {
        return Order::class;
    }

    public function changeStatus($id_order) {
        $table = static::getTableName();
        $sql = "UPDATE {$table} SET status = 'Отменен' WHERE id = '{$id_order}'";
        $params = [':id_order' => $id_order];
        $this->db->execute($sql, $params);
    }

    /**
     * Функция делает запрос на получение данных из БД по заданному id.
     */
    function getOrder() {
        $table = static::getTableName();
        //TODO: {$_SESSION['users']['id']}
        $sql = "SELECT id, date, total_cost, status FROM {$table} WHERE id_user = '1'";
        return $this->db->queryAll($sql);
    }

    public  function addOrder() {
        $session = App::call()->session;
        $db = App::call()->db;

        //Проверяем существование массива "cart" в текущей сессии.
        if ($session->get('cart')) {
            //Получаем все товары из корзины.
            $order_products =(new Cart())->getCartProd($session->get('cart'));
            //Получаем общую стоимость товаров.
            $total_cost = ($order_products[count($order_products) - 1]['total']);
            //Сохраняем в переменную текущее время.
            $datetime = time();
            $table = static::getTableName();
            //Делаем запрос на добавление заказа в таблицу "orders".
            $db->query("INSERT INTO {$table} (id_user, date, total_cost) 
        VALUES ('1', '{$datetime}', '{$total_cost}')");
            //TODO: Заглушка в таблице.
            //Получаем последний добавленный id.
            $lastInsertId = $db->queryOne("SELECT MAX(`id`) AS id FROM `orders`");

            //Обходим в цикле все товары из корзины.
            foreach ($order_products as $product => $value) {
                //Если это не последний элемент массива(в послуднем хранится общая стоимость).
                if ($product < count($order_products) - 1) {
                    //Добавляем товары в таблицу "order_items".
                    $db->query("INSERT INTO order_items (id_order, id_prod, item_price, quantity, login) 
              VALUES ('{$lastInsertId['id']}', '{$value['id']}', '{$value['price']}', '{$value['quantity']}', '{$_SESSION['users']['login']}')");
                }
            }
            //TODO: сессия удаление.
            //Очищаем корзину.
            $_SESSION['cart'] = [];
            //Делаем редирект на текущую страницу.
            header("Location: " . $_SERVER['REQUEST_URI']);
            //Прекращаем выполнение текущего скрипта.
            exit;
        }
    }

}