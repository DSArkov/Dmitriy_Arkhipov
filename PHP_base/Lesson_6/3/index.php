<?php
header("Content-type:text/html; charset=utf-8");

//Подключаем скрипты.
include __DIR__ . '/config/main.php';
include CONFIG_DIR . 'db.php';
include ENGINE_DIR . 'db.php';
include ENGINE_DIR . 'comments.php';

//Проверяем была ли нажата кнопка "Отправить".
if ($_REQUEST['submit']) {
    //Экранируем специальные символы в строках, если таковые имеются.
    $name = shieldingStr($_REQUEST['name']);
    $comment = shieldingStr($_REQUEST['comment']);
    //Добавляем комментарий в базу данных.
    addComment($name, $comment);
    //Делаем редирект страницы на саму себя для обновления содержимого.
    header("Location: index.php");
    //Завершаем выполнение скрипта.
    exit;
}

//Получаем комментарии из базы.
$comments = getComments();

//Подключаем html шаблон.
include TEMPLATE_DIR . 'comments.php';


