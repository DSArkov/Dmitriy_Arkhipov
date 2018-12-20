<?php
//Регистрируем класс в пространстве имён.
namespace app\validators;

//Импортируем класс.
use yii\validators\Validator;


class TaskDateValidator extends Validator
{
    public function relevantDate($attribute, $params)
    {
        $date = $this->$attribute;
        $dateNow = date('d.m.Y');
        if (strtotime($date) < strtotime($dateNow)) {
            $this->addError($attribute, "Дата должна быть больше текущей.");
        }
    }
}