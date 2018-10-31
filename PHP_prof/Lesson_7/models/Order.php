<?php

//Регистрируем класс в пространстве имен "app\models".
namespace app\models;

//Создаем класс "Order", который наследуется от "DataEntity".
class Order extends DataEntity
{
    //Объявляем переменные.
    public $id;
    public $id_user;
    public $date;
    public $status;
    public $total_cost;
}