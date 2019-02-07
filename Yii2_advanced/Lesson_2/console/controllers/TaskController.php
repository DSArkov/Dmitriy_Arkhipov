<?php

//Регистрируем класс в пространстве имён.
namespace app\commands;

//Импортирем классы.
use common\models\tables\Tasks;
use yii\console\Controller;


//Класс отвечет за работу с задачами через консоль.
class TaskController extends Controller
{
    /**
     * Метод находит задачи с истекающим сроком выполнения и информирет об этом
     * ответственное лицо.
     */
    public function actionDeadline()
    {
        /** @var Tasks[] $tasks */
        $tasks = Tasks::find()
            ->where('DATEDIFF(NOW(), date_end) <= 1')
            ->all();

        foreach ($tasks as $task) {
            \Yii::$app->mailer->compose()
                ->setTo($task->responsible->email)
                ->setFrom('info@tasks.ru')
                ->setSubject('Task reminder')
                ->setTextBody("Remind, that execution time of task '{$task->title}' is running out at {$task->date_end}.")
                ->send();
        }
    }
}