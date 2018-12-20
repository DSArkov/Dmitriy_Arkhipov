<?php
//Регистрируем класс в пространстве имён.
namespace app\models;


//Импортируем класс.
use yii\base\Model;

class Task extends Model
{
    public $title;
    public $owner;
    public $status;
    public $dateCreate;
    public $dateStart;
    public $dateEnd;
    public $description;

    /**
     * Метод описывает правила валидации.
     * @return array - Возвращает массив с правилами.
     */
    public function rules()
    {
        return [
            //Поле "title" и "description" обязательны для заполнения.
            [['title', 'owner', 'status', 'dateCreate', 'description'], 'required',
                'message' => 'Данное поле обязательно для заполнения.'],
            //Максимальная длина поля "title" - 64 символа.
            [['title'], 'string', 'min' => 8, 'max' => 64,
                'tooShort' => 'Минимальное количество символов - 8.',
                'tooLong' => 'Максимальное количество символов - 64.'],
            //Максимальная длина поля "description" - 512 символов.
            [['description'], 'string', 'min' => '32', 'max' => 512,
                'tooShort' => 'Минимальное количество символов - 32.',
                'tooLong' => 'Максимальное количество символов - 512.'],
            //Значение по умолчанию поля "status" - "Новая".
            [['status'], 'default', 'value' => 'Новая'],
            //Значение по умолчанию поля "dateCreate" - текущая дата.
            [['dateCreate'], 'default', 'value' => date('d.m.Y')],
            //Поле "dateStart" должно быть датой.
            [['dateStart'], 'date'],
            //Поле "dateEnd" должно быть датой.
            [['dateEnd'], 'date']
        ];
    }

    /**
     * Метод создаёт новую задачу.
     */
    public function create()
    {

    }

    /**
     * Метод изменяет существующую задачу.
     */
    public function modify()
    {

    }

    /**
     * Метод удаляет существующую задачу.
     */
    public function delete()
    {

    }
}