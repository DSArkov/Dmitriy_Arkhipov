<?php

//Создаём константу для хранения пути к корневой директории.
define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT'] . "/../");
//Создаём константу для хранения пути к директории с шаблонами.
define("TEMPLATES_DIR", ROOT_DIR . "views/");
//Создаём константу для хранения пути к директории с шаблонами Twig.
define("TWIG_DIR", TEMPLATES_DIR . "twig/");
//Создаём константу для хранения имени контроллера по умолчанию.
define("DEFAULT_CONTROLLER", "product");
//Создаём константу для хранения названия пространства имен контроллеров.
define("CONTROLLERS_NAMESPACE", "app\\controllers");