<?php

//Регистрируем класс в пространстве имён.
namespace common\models\tables;

//Используем классы.
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "task_statuses".
 *
 * @property int $id
 * @property string $title
 *
 * @property Tasks[] $tasks
 */
class TaskStatuses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::class, ['status_id' => 'id']);
    }

    /**
     * Статический метод для получения списка статусов.
     * @return array - Ассоциативный массив, где "id" - ключ, а "title" - значение.
     */
    public static function getStatusesList()
    {
        $statuses = static::find()
            ->select(['id', 'title'])
            ->asArray()
            ->all();
        return ArrayHelper::map($statuses, 'id', 'title');
    }
}
