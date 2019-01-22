<?php

//Регистрируем класс в пространстве имён.
namespace app\models\tables;


//Используем классы.
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 */
class Users extends \yii\db\ActiveRecord
{
    //Создаём сценарий авторизации.
    const SCENARIO_AUTH = 'auth';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
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
            [['login', 'password'], 'required'],
            ['login', 'string', 'max' => 16],
            ['email', 'email'],
            ['password', 'string', 'max' => 32],
            [['created_at', 'updated_at'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'email' => 'Email',
            'role_id' => 'Role',
            'created_at' => 'Date create',
            'updated_at' => 'Date update'
        ];
    }

    /**
     * Метод определяет возвращаемые поля при разных сценариях.
     * @return array|false
     */
    public function fields()
    {
        if ($this->scenario == self::SCENARIO_AUTH) {
            return [
                'id',
                'username' => 'login',
                'password'
            ];
        }
        return parent::fields();
    }

    /**
     * Статический метод для получения списка пользователей.
     * @return array - Ассоциативный массив, где "id" - ключ, а "login" - значение.
     */
    public static function getUsersList()
    {
        $users = static::find()
            ->select(['id', 'login'])
            ->asArray()
            ->all();
        return ArrayHelper::map($users, 'id', 'login');
    }
}
