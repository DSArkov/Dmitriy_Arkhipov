<?php

//Регистрируем класс в пространстве имён.
namespace frontend\widgets;


//Используем классы.
use common\models\tables\Tasks;
use yii\base\Widget;

//Виджет, который отвечает за отображение карточки задачи.
class Task extends Widget
{
    public $model;

    /**
     * Метод возвращает результат рендеринга виджета.
     * @return string - Возвращает строку с данными для вывода на экран.
     * @throws \Exception - Если модель не является экземпляром класса "Tasks".
     */
    public function run()
    {
        if (is_a($this->model, Tasks::class)) {
            $taskClass = 'task-in-process';
            if (($this->model->date_end < date('Y-m-d')) && ($this->model->status_id != 7)) {
                $taskClass = 'task-overdue';
            }
            return $this->render('task', ['model' => $this->model, 'taskClass' => $taskClass]);
        }
        throw new \Exception('Невозможно отобразить модель задачи.');
    }
}