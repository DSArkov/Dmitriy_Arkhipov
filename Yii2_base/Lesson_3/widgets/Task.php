<?php

//Регистрируем класс в пространстве имён.
namespace app\widgets;


//Используем классы.
use app\models\tables\Tasks;
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
            return $this->render('task', ['model' => $this->model]);
        }
        throw new \Exception('Невозможно отобразить модель задачи.');
    }
}