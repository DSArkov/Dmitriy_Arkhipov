<?php

//Регистрируем класс в пространстве имён.
namespace frontend\controllers;

//Импортируем классы.
use common\models\tables\Tasks;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;


/**
 * Class TaskApiController
 * @package frontend\controllers
 */
class TaskApiController extends ActiveController
{
    public $modelClass = Tasks::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::class,
                    'auth' => function ($username, $password) {
                        $user = User::findByUsername($username);
                        if ($user !== null && $user->validatePassword($password)) {
                            return $user;
                        }
                        return null;
                    }
                ],
                [
                    'class' => QueryParamAuth::class,
                    'tokenParam' => 'token'
                ]
            ]
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        $filter = \Yii::$app->request->get('filter');
        $query = Tasks::find();
        if ($filter) {
            $query->filterWhere($filter);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}