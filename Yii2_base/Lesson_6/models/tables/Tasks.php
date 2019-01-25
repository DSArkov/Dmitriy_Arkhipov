<?php

//Регистрируем класс в пространстве имён.
namespace app\models\tables;


//Используем классы.
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title
 * @property int $owner_id
 * @property int $responsible_id
 * @property string $created_at
 * @property string $date_start
 * @property string $date_end
 * @property string $description
 * @property string $updated_at
 * @property int $status_id
 *
 * @property Users $responsible
 * @property Users $owner
 * @property TaskStatuses $status
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * Метод-поведение, который добавляет временную метку к полям "created_at" и "updated_at".
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'responsible_id'], 'required'],
            [['created_at', 'updated_at', 'date_start', 'date_end', 'responsible_id', 'owner_id', 'status_id'], 'safe'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('task', 'task_name'),
            'owner_id' => Yii::t('task', 'task_owner'),
            'responsible_id' => Yii::t('task', 'task_responsible'),
            'status_id' => Yii::t('task', 'task_status'),
            'created_at' => 'Date create',
            'date_start' => Yii::t('task', 'task_start'),
            'date_end' => Yii::t('task', 'task_finish'),
            'description' => Yii::t('task', 'task_description'),
            'updated_at' => 'Date update'
        ];
    }

    /**
     * Метод устанавливает связь между двумя таблицами по определённым полям.
     * @return \yii\db\ActiveQuery
     */
    public function getResponsible()
    {
        return $this->hasOne(Users::class, ['id' => 'responsible_id']);
    }

    /**
     * Метод устанавливает связь между двумя таблицами по определённым полям.
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Users::class, ['id' => 'owner_id']);
    }

    /**
     * Метод устанавливает связь между двумя таблицами по определённым полям.
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(TaskStatuses::class, ['id' => 'status_id']);
    }

    /**
     * Метод устанавливает связь между двумя таблицами по определённым полям.
     * @return \yii\db\ActiveQuery
     */
    public function getTaskAttachments()
    {
        return $this->hasMany(TaskAttachments::class, ['task_id' => 'id']);
    }

    /**
     * Метод устанавливает связь между двумя таблицами по определённым полям.
     * @return \yii\db\ActiveQuery
     */
    public function getTaskComments()
    {
        return $this->hasMany(TaskComments::class, ['task_id' => 'id']);
    }

    /**
     * Метод получает список всех задач по ответственному лицу.
     * @param $responsibleId
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getTasksByResponsible($responsibleId)
    {
        return static::find()
            ->where(['responsible_id' => $responsibleId])
            ->all();
    }
}