<?php

//Регистрируем класс в пространстве имен "app\models\repositories".
namespace app\models\repositories;

//Используем класс:
use app\models\Product;


//Класс-хранилище для продуктов.
class ProductRepository extends Repository
{
    /**
     * Метод возвращает название таблицы БД, к которой будем обращаться.
     * @return string - Название таблицы.
     */
    public function getTableName()
    {
        return 'catalogue';
    }

    /**
     * Метод возвращает имя класса "Product".
     * @return string - Имя класса.
     */
    public function getEntityClass()
    {
        return Product::class;
    }
}