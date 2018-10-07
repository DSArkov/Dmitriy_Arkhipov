<?php
header("Content-type:text/html; charset=utf-8");

//Подключаем скрипты.
include __DIR__ . '/../config/main.php';
require_once ENGINE_DIR . 'autoload.php';


//Стартуем новую сессию либо возобновляем существующую.
session_start();

//Создаем переменную для хранения сообщения об ошибке.
$message = '';
//Проверяем пришли ли нам данные методом POST.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Получаем login из запроса.
    $login = $_POST['login'];
    //Получаем password из запроса.
    $password = $_POST['password'];

    //Проверяем совпадает ли пара логин/пароль с теми, что есть в базе.
    if ($user = getUserByLoginPass($login, $password)) {
        //Очищаем массив на случай, если в нем уже содержаться какие-то данные.
        $_SESSION = [];
        //Записываем id в сессию.
        $_SESSION['users']['id'] = $user['id'];
        //И логин для отображения приветствия.
        $_SESSION['users']['login'] = $login;
        //Обновляем страницу.
        redirect('index.php');
    }

    //Если данные не совпали - выводим сообщение.
    $message = 'Неправильная пара логин/пароль';
}

//Отрисовываем шаблон передавая параметры функции render.
render('login', ['message' => $message] );