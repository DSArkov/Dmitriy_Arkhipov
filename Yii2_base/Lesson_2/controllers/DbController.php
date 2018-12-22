<?php
//Регистрируем класс в пространстве имён.
namespace app\controllers;


//Импортируем классы.
use app\models\tables\Tasks;
use yii\web\Controller;

//Контроллер "Db".
class DbController extends Controller
{
    /**
     * Основной метод(по умолчанию).
     */
    public function actionIndex()
    {
        $task = Tasks::findOne(2);
        //var_dump($task->user);
        //var_dump($task);
    }
}