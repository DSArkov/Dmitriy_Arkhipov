<?php

//Регистрируем класс в пространстве имён.
namespace frontend\assets;

//Импортируем класс.
use yii\web\AssetBundle;


/**
 * Task page asset bundle.
 */
class TaskAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/task.css'
    ];
    public $js = [
        'js/chat.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}