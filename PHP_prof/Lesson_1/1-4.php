<?php
header("Content-type:text/html; charset:utf-8");

//Опысываем класс "Продукт".
class Product {
    /**
     * Конструктор класса. Выполняется в тот момент, когда мы создаем новый экземпляр.
     * @param int $id - id продукта.
     * @param string $title - Название.
     * @param string $description - Описание.
     * @param int $price - Цена.
     */
    function __construct($id = null, $title = null, $description = null, $price = null) {
        $this -> id = $id;
        $this -> title = $title;
        $this -> description = $description;
        $this -> price = $price;
    }

    /**
     * Функция выводит на экран данные о продукте.
     */
    function display() {
        echo $this -> prepareTitle() . $this -> prepareDescription() . $this -> preparePrice();
    }

    /**
     * Функция подготавливает название для вывода на экран.
     * @return string - Возвращает строку с данными.
     */
    function prepareTitle() {
        return "Название: {$this -> title}<br>";
    }

    /**
     * Функция подготавливает описание для вывода на экран.
     * @return string - Возвращает строку с данными.
     */
    function prepareDescription() {
        return "Описание: {$this -> description}<br>";
    }

    /**
     * Функция подготавливает цену для вывода на экран.
     * @return string - Возвращает строку с данными.
     */
    function preparePrice() {
        return "Стоимость: {$this -> price}<br>";
    }
}

//Создаем новый экземпляр класса.
$product1 = new Product(1, 'Чайник', 'Очень удобный чайник', 100);
//Вызываем метод "display" для вывода данных на экран.
$product1 -> display();


//Описываем класс "Одежда", который наследуется от класса "Продукт".
class Clothes extends Product {
    /**
     * Конструктор класса. Выполняется в тот момент, когда мы создаем новый экземпляр.
     * @param int $id - id продукта.
     * @param string $title - Название.
     * @param string $description - Описание.
     * @param int $price - Цена.
     * @param string $size - Размер.
     */
    function __construct($id = null, $title = null, $description = null, $price = null, $size)
    {
        //Наследуем родительский конструктор.
        parent::__construct($id, $title, $description, $price);
        //Переопределяем его.
        $this -> size = $size;
    }

    /**
     * Функция выводит на экран данные о продукте.
     */
    function display() {
        //Наследуем родительский метод.
        parent::display();
        //Переопределяем его.
        echo $this -> prepareSize();
    }

    /**
     * Функция подготавливает размер для вывода на экран.
     * @return string - Возвращает строку с данными.
     */
    function prepareSize() {
        return "Размер: {$this -> size}<br>";
    }
}

//Создаем новый экземпляр класса.
$product2 = new Clothes(2, 'Футболка', 'Самая стильная футболка', '20', 'XL');
//Вызываем метод "display" для вывода данных на экран.
$product2 -> display();