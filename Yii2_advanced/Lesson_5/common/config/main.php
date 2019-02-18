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
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
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
        ],
        'rbac' => [
            'class' => 'dektrium\rbac\RbacWebModule',
            'admins' => ['admin']
        ],
    ],
];