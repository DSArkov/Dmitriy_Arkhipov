<?php

//Регистрируем класс в пространстве имён.
namespace app\models\tables;


/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'authKey', 'accessToken'], 'required'],
            [['username'], 'string', 'max' => 16],
            [['password', 'authKey', 'accessToken'], 'string', 'max' => 32],
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
        ];
    }

    /**
     * Метод определяет возвращаемые поля при разных сценариях.
     * @return array|false
     */
    public function fields() {
        if ($this->scenario == self::SCENARIO_AUTH) {
            return [
                'id',
                'username' => 'login',
                'password'
            ];
        }
        return parent::fields();
    }
}
