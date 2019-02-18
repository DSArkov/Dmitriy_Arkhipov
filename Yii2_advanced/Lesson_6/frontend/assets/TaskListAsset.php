<?php

//Регистрируем класс в пространстве имён.
namespace frontend\assets;

//Используем класс.
use yii\web\AssetBundle;


/**
 * Tasks page asset bundle.
 */
class TaskListAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/tasks.css',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}