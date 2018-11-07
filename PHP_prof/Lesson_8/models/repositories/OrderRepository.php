<?php

//Регистрируем класс в пространстве имён.
namespace app\models\repositories;

//Используем классы:.
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
    public function getTableName()
    {
        return 'orders';
    }

    /**
     * Метод возвращает имя класса "Order".
     * @return string - Имя класса.
     */
    public function getEntityClass()
    {
        return Order::class;
    }

    /**
     * Метод для смены статуса в таблице БД.
     * @param string $id_order - id заказа.
     */
    public function changeStatus($id_order)
    {
        //Получаем имя таблицы БД.
        $table = static::getTableName();
        //Сохраняем запрос в переменную.
        $sql = "UPDATE {$table} SET status = 'Отменен' WHERE id = '{$id_order}'";
        //Сохраняем параметры в переменную.
        $params = [':id_order' => $id_order];
        //Вызываем метод, который выполняет запрос.
        $this->db->execute($sql, $params);
    }

    /**
     * Метод делает запрос на получение данных из БД по заданному id.
     * @return array - Возвращает массив, содержащий все строки результирующего набора.
     */
    function getOrder()
    {
        //Получаем имя таблицы БД.
        $table = static::getTableName();
        //Сохраняем запрос в переменную.
        //TODO: {$_SESSION['users']['id']}.
        $sql = "SELECT id, date, total_cost, status FROM {$table} WHERE id_user = '1'";
        //Возвращает массив с результатами.
        return $this->db->queryAll($sql);
    }

    /**
     * Метод добавляет заказ в БД.
     */
    public function addOrder()
    {
        //Стартуем сессию либо возобнавляем существующую.
        $session = App::call()->session;
        //Создаём экземпляр класса "Db", либо используем существующий.
        $db = App::call()->db;

        //Проверяем существование массива "cart" в текущей сессии.
        if ($session->get('cart')) {
            //Получаем все товары из корзины.
            $order_products = (new Cart())->getCartProd($session->get('cart'));
            //Получаем общую стоимость товаров.
            $total_cost = ($order_products[count($order_products) - 1]['total']);
            //Сохраняем в переменную текущее время.
            $datetime = time();
            //Получаем название таблицы в БД.
            $table = static::getTableName();

            //TODO: Заглушка id_user.
            //Делаем запрос на добавление заказа в таблицу "orders".
            $db->query("INSERT INTO {$table} (id_user, date, total_cost) 
        VALUES ('1', '{$datetime}', '{$total_cost}')");

            //Получаем последний добавленный id.
            $lastInsertId = $db->queryOne("SELECT MAX(`id`) AS id FROM `orders`");

            //Обходим в цикле все товары из корзины.
            foreach ($order_products as $product => $value) {
                //Если это не последний элемент массива(в последнем хранится общая стоимость).
                if ($product < count($order_products) - 1) {
                    //Добавляем товары в таблицу "order_items".
                    //TODO: сессия.
                    $db->query("INSERT INTO order_items (id_order, id_prod, item_price, quantity, login) 
              VALUES ('{$lastInsertId['id']}', '{$value['id']}', '{$value['price']}', '{$value['quantity']}', '{$_SESSION['users']['login']}')");
                }
            }

            //TODO: сессия.
            //Очищаем корзину.
            $_SESSION['cart'] = [];
            //Делаем редирект на текущую страницу.
            header("Location: " . $_SERVER['REQUEST_URI']);
            //Прекращаем выполнение скрипта.
            exit;
        }
    }

}