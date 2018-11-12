<?php

//Регистрируем класс в пространстве имён.
namespace app\base;


//Класс-хранилище для работы с компонентами.
class Storage
{
    //Создаём массив, в котором будут находится компоненты.
    private $items = [];

    /**
     * Метод добавляет компонент в хранилище по ключу.
     * @param string $key - Ключ.
     * @param mixed $object - Компонент, который необходимо добавить.
     */
    public function set($key, $object)
    {
        $this->items[$key] = $object;
    }

    /**
     * Метод получает компонент из хранилища.
     * @param string $key - Ключ, по которому осуществляется поиск.
     * @return mixed - Возвращает компонент.
     */
    public function get($key)
    {
        //Проверяем наличие компонента в хранилище.
        if (!isset($this->items[$key])) {
            //Если такового нет - создаём его.
            $this->items[$key] = App::call()->createComponent($key);
        }
        //Возвращаем компонент.
        return $this->items[$key];
    }
}