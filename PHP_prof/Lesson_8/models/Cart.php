<?php

//Регистрируем класс в пространстве имен "app\models".
namespace app\models;


//Класс, реализующий логику работы с корзиной.
use app\services\Session;

class Cart
{
    private function getData() {
        $session = Session::getInstance();
        return $session -> get('cart');
    }

    public function getCart() {

    }

    public function add($productId, $qty) {

    }

}