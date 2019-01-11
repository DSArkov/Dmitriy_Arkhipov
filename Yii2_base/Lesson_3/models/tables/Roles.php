<?php

namespace app\models\tables;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "roles".
 *
 * @property int $id
 * @property string $title
 *
 * @property Users[] $users
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 16],
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
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['role_id' => 'id']);
    }

    /**
     * Статический метод для получения списка ролей.
     * @return array - Ассоциативный массив, где "id" - ключ, а "title" - значение.
     */
    public static function getRolesList()
    {
        $roles = static::find()
            ->select(['id', 'title'])
            ->asArray()
            ->all();
        return ArrayHelper::map($roles, 'id', 'title');
    }
}
