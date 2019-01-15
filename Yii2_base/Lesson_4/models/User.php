<?php

//Регистрируем класс в пространстве имён.
namespace app\models;


//Импортируем класс.
use app\models\tables\Users;

//Модель "User".
class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    //Объявляем публичные свойства.
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;


    /**
     * Метод осуществляет поиск пользователя в БД по id.
     * @param int $id
     * @return object|null
     */
    public static function findIdentity($id)
    {
        if ($user = Users::findOne($id)) {
            $user->setScenario(Users::SCENARIO_AUTH);
            return new static($user->toArray());
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null) {}

    /**
     * Метод осуществляет поиск пользователя в БД по логину.
     * @param string $username
     * @return object|null
     */
    public static function findByUsername($username)
    {
        if ($user = Users::findOne(['login' => $username])) {
            $user->setScenario(Users::SCENARIO_AUTH);
            return new static($user->toArray());
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
