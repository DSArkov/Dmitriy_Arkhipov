<?php

//Создаём массив с настройками приложения.
return [
    'rootDir' => __DIR__ . '/../',
    'templatesDir' => __DIR__ . '/../views/',
    'defaultController' => 'product',
    'controllerNamespace' => 'app\\controllers',
    'components' => [
        'db' => [
            'class' => app\services\Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => '',
            'database' => 'little_shop',
            'charset' => 'utf8',
            'port' => 3306
        ],
        'request' => [
            'class' => \app\services\Request::class
        ],
        'renderer' => [
            'class' => \app\services\renderers\TemplateRenderer::class
        ],
        'session' => [
            'class' => \app\services\Session::class
        ]
    ]
];