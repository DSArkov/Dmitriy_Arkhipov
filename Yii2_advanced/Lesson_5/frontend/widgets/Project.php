<?php

//Регистрируем класс в пространстве имён.
namespace frontend\widgets;

//Импортируем классы.
use common\models\tables\Projects;
use common\models\tables\Tasks;
use yii\base\Widget;


//Виджет, который отвечает за отображение карточки проекта.
class Project extends Widget
{
    public $model;

    /**
     * Метод возвращает результат рендеринга виджета.
     * @return string - Возвращает строку с данными для вывода на экран.
     * @throws \Exception - Если модель не является экземпляром класса "Projects".
     */
    public function run()
    {
        if (is_a($this->model, Projects::class)) {
            $tasksCount = Tasks::find()->where(['project_id' => $this->model->id])->count();

            return $this->render('project', [
                'model' => $this->model,
                'tasksCount' => $tasksCount
            ]);
        }
        throw new \Exception('Невозможно отобразить модель проекта.');
    }
}