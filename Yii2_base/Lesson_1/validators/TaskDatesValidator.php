<?php
//Регистрируем класс в пространстве имён.
namespace app\validators;

//Импортируем класс.
use yii\validators\Validator;


class TaskDateValidator extends Validator
{
    public function relevantDate($model, $attribute)
    {
        if ($this->$attribute < date('d.m.Y')) {
            $model->addError();
        }
    }
}