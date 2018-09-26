<?php
header("Content-type: text/html; charset=utf-8");

include  __DIR__ . '/../config/main.php';
include ENGINE_DIR . "getImg_db.php";
include ENGINE_DIR . "connect_db.php";
include ENGINE_DIR . "query_db.php";
include ENGINE_DIR . "increaseCount_db.php";


//Получаем из базы информацию об изображении с указанным id.
$res = getImg($_GET['id']);
//Увеличиваем кол-во просмотров на единицу.
increaseCount($_GET['id'], $res['count']);

//Подключаем страницу для отдельной картинки.
include TEMPLATES_DIR . 'single_img.php';
