<?php
return [
    'bootstrap' => ['bootstrap'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@img' => '@frontend/web/img',
        '@msg' => '@frontend/messages'
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'bootstrap' => [
            'class' => \common\components\Bootstrap::class
        ],
//        'user' => [
//            'enableSession' => false,
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
//            'identityCookie' => ['name' => '_identity', 'httpOnly' => true, 'domain' => $params['cookieDomain']],
//        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => \yii\rest\UrlRule::class,
                    'controller' => 'task-api',
                    'pluralize' => false
                ]
//                'GET task-api' => 'task-api/index',
//                'POST task-api' => 'task-api/create',
//                'GET task-api/<id>' => 'task-api/view',
//                'PATCH task-api/<id>' => 'task-api/update',
//                'DELETE task-api/<id>' => 'task-api/delete'
            ]
        ],
        'bot' => [
            'class' => 'SonkoDmitry\Yii\TelegramBot\Component',
            'apiToken' => '726132481:AAG4sfcP_DBATqfPikhQ8vSJcwTi_jBzBqE',
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin'],
            'enableConfirmation' => false,
            'modelMap' => [
                'User' => 'common\models\User',
            ],
        ],
        'rbac' => [
            'class' => 'dektrium\rbac\RbacWebModule',
            'admins' => ['admin']
        ],
    ],
];