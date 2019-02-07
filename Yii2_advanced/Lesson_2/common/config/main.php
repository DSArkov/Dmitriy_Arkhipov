<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@img' => '@frontend/web/img',
        '@msg' => '@frontend/messages'
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => ['common\components\bootstrap'],
    'components' => [
        'i18n' => [
            'translations' => [
                'task*' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => '@msg',
                ]
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
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