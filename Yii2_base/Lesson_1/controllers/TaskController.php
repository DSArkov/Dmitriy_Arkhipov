<?php
//Регистрируем класс в пространстве имён.
namespace app\controllers;


//Импортируем классы.
use yii\web\Controller;
use app\models\Task;

//Контроллер "Task".
class TaskController extends Controller
{
    /**
     * Основной метод(по умолчанию).
     * @return string - Возвращает строку с данными для вывода на экран.
     */
    public function actionIndex()
    {
        //Создаём новый экземпляр "Задачи".
        $task = new Task();
        //Массово инициализируем параметры.
        $task->load([
            'Task' =>
            [
                'title' => 'Важная задача',
                'owner' => 'Преподаватель',
                'user' => 'Студент',
                'status' => 'Новая',
                'dateCreate' => date('d.m.Y'),
                'dateStart' => '22.12.2018',
                'dateEnd' => '29.12.2018',
                'description' => 'Какой-то текст с описанием задачи...'
            ]
        ]);
        //Валидируем данные.
        var_dump($task->validate());
        //Смотрим наличие ошибок.
        var_dump($task->getErrors());
        //Возвращаем метод, который рендерит шаблон с необходимыми параметрами.
        return $this->render('index', ['task' => $task]);
    }
}