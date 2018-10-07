<?php

//Подключаем скрипты.
include __DIR__ . '/../config/main.php';
require_once ENGINE_DIR . 'autoload.php';


//Стартуем новую сессию либо возобновляем существующую.
session_start();

//Очищааем сессию.
$_SESSION = [];

//Делаем переадресацию на каталог.
redirect('index.php');