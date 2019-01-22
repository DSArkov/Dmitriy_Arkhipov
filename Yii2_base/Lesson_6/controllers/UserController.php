<?php

//Регистрируем класс в пространстве имён.
namespace app\controllers;


//Используем классы.
use app\models\tables\Tasks;
use yii\web\Controller;

//Контроллер пользователей.
class UserController extends Controller
{
    /**
     * Метод по умолчанию.
     */
    public function actionIndex()
    {
        $userId = \Yii::$app->user->id;

        $cache = \Yii::$app->cache;
        $key = 'user_tasklist_' . $userId;
        if (!$taskList = $cache->get($key)) {
            $taskList = Tasks::getTasksByResponsible($userId);
            $cache->set($key, $taskList, 500);
        }

        return $this->render('index', ['taskList' => $taskList]);
    }
}