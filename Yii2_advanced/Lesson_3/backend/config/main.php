<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'name' => 'Task-tracker',
    'language' => 'en',
    'homeUrl' => '/',
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'components' => [
        'i18n' => [
            'translations' => [
                'task*' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => '@msg',
                ]
            ]
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@backend/views/admin'
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'cookieValidationKey' => $params['cookieValidationKey'],
            'baseUrl'=>'/admin',
        ],
//        'user' => [
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
//            'identityCookie' => ['name' => '_identity', 'httpOnly' => true, 'domain' => $params['cookieDomain']],
//        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced',
            'cookieParams' => [
                'httpOnly' => true,
                'domain' => $params['cookieDomain'],
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
//        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
//            'enableStrictParsing' => false,
//            'rules' => [
//            ],
//        ],
    ],
    'params' => $params,
];
