<?php
//Регистрируем класс в пространстве имён.
namespace app\controllers;


//Импортируем классы.
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\tables\Tasks;

//Контроллер "Task".
class TaskController extends Controller
{
    /**
     * Основной метод(по умолчанию).
     * @return string - возвращает строку с данными для вывода на экран.
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider(
        [
            'query' => Tasks::find(),
            'pagination' => [
                'pageSize' => 5
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Метод отображает карточку задачи.
     * @param integer $id - идентификатор задачи.
     * @return string - возвращает строку с данными для вывода на экран.
     */
    public function actionTask($id)
    {
        $task = Tasks::findOne($id);

        return $this->render('task', [
            'task' => $task
        ]);

//        //Создаём новый экземпляр "Задачи".
//        $task = new Task();
//        //Массово инициализируем параметры.
//        $task->load([
//            'Task' =>
//            [
//                'title' => 'Важная задача',
//                'owner' => 'Преподаватель',
//                'user' => 'Студент',
//                'status' => 'Новая',
//                'dateCreate' => date('d.m.Y'),
//                'dateStart' => '22.12.2018',
//                'dateEnd' => '29.12.2018',
//                'description' => 'Какой-то текст с описанием задачи...'
//            ]
//        ]);
//        //Валидируем данные.
//        //var_dump($task->validate());
//        //Смотрим наличие ошибок.
//        //var_dump($task->getErrors());
//        //Возвращаем метод, который рендерит шаблон с необходимыми параметрами.
//        return $this->render('index', ['task' => $task]);
    }
}