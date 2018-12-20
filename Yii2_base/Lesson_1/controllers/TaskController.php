<?php
//Регистрируем класс в пространстве имён.
namespace app\controllers;


//Импортируем классы.
use yii\web\Controller;
use app\models\Task;

class TaskController extends Controller
{
    public function actionIndex()
    {
        $task = new Task();
        $task->load([
            'Task' =>
            [
                'title' => 'Новая задача',
                'owner' => 'Владелец',
                'status' => 'В работе',
                'dateCreate' => date('d.m.Y'),
                'description' => 'Какой-то текст с описанием задачи'
            ]
        ]);
        var_dump($task->validate());
        var_dump($task->getErrors());
    }
}