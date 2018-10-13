<?php

//Класс реализует автоматическое подключение скриптов.
class Autoloader
{
    /**
     * Функция формирует полный путь к файлу и подключает его.
     * @param string $className - Имя класса, который необходимо подключить.
     */
    public function loadClass($className) {
        //Формируем строку с именем, включающее в себя пространство имен.
        $filename = $_SERVER['DOCUMENT_ROOT'] . "/{$className}.php";
        //Убираем глобальное пространство имен "app\", чтобы получить полный путь.
        $path = str_replace('app\\', '', $filename);
        //Если файл существует.
        if (file_exists($path)) {
            //Подключаем его.
            include $path;
        }
    }
}