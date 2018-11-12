<?php

//Регистрируем класс в пространстве имен.
namespace app\models;

//Используем классы:
use app\base\App;
use app\models\repositories\ProductRepository;


//Класс "Cart" определяет методы для работы с корзиной.
class Cart extends DataEntity
{
    /**
     * Метод проверяет наличие продукта с определенным id в массиве $_SESSION. Если
     * таковой отсутствует - добавляет его и считает количество.
     * @param string $id - id продукта.
     * @param int $quantity - Количество единиц товара(по умолчанию = 1).
     */
    function addToCart($id, $quantity = 1)
    {
        //Стартуем новую сессию либо возобновляем существующую.
        $session = App::call()->session;

        //Проверяем наличие продукта в массиве $_SESSION.
        if (isset($session->get('cart')[$id])) {
            //Если есть, то увеличиваем количество на 1.
            $qty = $session->get('cart')[$id]['quantity'] + 1;
            //И меняем значение в сессии.
            $session->set(['cart', $id, 'quantity'], $qty);
        } else {
            //Если нет - добавляем и присваеваем количество равное единице.
            $session->set(['cart', $id, 'quantity'], $quantity);
        }
    }

    /**
     * Метод уменьшает количество товара в корзине, либо удаляет товар полностью,
     * если он в единичном экземпляре.
     * @param string $id - id продукта.
     * @param int $quantity - Количество единиц товара(по умолчанию = 1).
     */
    function deleteFromCart($id, $quantity = 1)
    {
        //Стартуем новую сессию либо возобновляем существующую.
        $session = App::call()->session;

        //Если количество товара равно 1.
        if ($session->get('cart')[$id]['quantity'] == 1) {
            //TODO: Удаление элемента массива из Сессии.
            //Удаляем данный продукт из массива.
            unset($_SESSION['cart'][$id]);
        } else {
            //Иначе получаем количество минус 1.
            $qty = ($session->get('cart'))[$id]['quantity'] - $quantity;
            //И изменяем значение в сессиии.
            $session->set(['cart', $id, 'quantity'], $qty);
        }
    }

    /**
     * Метод формирует массив с данными о товарах, которые были добавлены в корзину.
     * @param array $arr - Массив добавленных товаров.
     * @return array - Сформированный массив с необходимой информацией.
     */
    function getCartProd($arr = [])
    {
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
                $prod = (new ProductRepository)->getOne($prod_id);
                //Получаем количество единиц товара, который добавили.
                $prod_quantity = $value['quantity'];
                //Считаем общую стоимость товара.
                $totalPrice = (int)$prod['price'] * $prod_quantity;
                //Прибавляем её к общей стимости всех товаров.
                $totalProdCost += $totalPrice;
                //Добавляем данные в массив.
                $arrProd[] = [
                    'id' => $prod_id,
                    'url' => $prod['url'],
                    'title' => $prod['title'],
                    'price' => $prod['price'],
                    'quantity' => $prod_quantity,
                    'cost' => $totalPrice
                ];
            }
            //Добавляем в массив общую стоимость всех товаров.
            $arrProd[] = ['total' => $totalProdCost];
        }

        //Возвращаем массив с данными о товарах.
        return $arrProd;
    }
}