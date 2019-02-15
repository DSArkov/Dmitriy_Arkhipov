<?php

//Регистрируем класс в пространстве имён.
namespace frontend\assets;

//Используем класс.
use yii\web\AssetBundle;


/**
 * Tasks page asset bundle.
 */
class ProjectListAssert extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/projects.css',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}