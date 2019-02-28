<?php

//Регистрируем класс в пространстве имён.
namespace frontend\controllers;

//Импортируем классы.
use common\models\tables\Tasks;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;


/**
 * Класс выводит статистику по задачам для администратора.
 * @package frontend\controllers
 */
class StatisticsController extends Controller
{
    /**
     * Поведенческий метод, расширяющий существующий функционал.
     * @return array
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Метод подготавливает данные для рендеринга.
     * @return string
     */
    public function actionIndex()
    {
        $dataProviderAll = new ActiveDataProvider([
            'query' => Tasks::find(),
            'pagination' => [
                'pageSize' => 25,
            ],
        ]);
        $countAll = $dataProviderAll->getTotalCount();

        $sqlForClosed = 'SELECT * FROM tasks WHERE TO_DAYS(NOW()) - TO_DAYS(date_end) <= 7';
        $dataProviderClosed = new ActiveDataProvider([
            'query' => Tasks::findBySql($sqlForClosed),
            'pagination' => [
                'pageSize' => 25,
            ],
        ]);
        $countClosed = $dataProviderClosed->getTotalCount();

        $sqlForOverdue = 'SELECT * FROM tasks WHERE status_id <> 7 AND date_end < NOW()';
        $dataProviderOverdue = new ActiveDataProvider([
            'query' => Tasks::findBySql($sqlForOverdue),
            'pagination' => [
                'pageSize' => 25,
            ],
        ]);
        $countOverdue = $dataProviderOverdue->getTotalCount();

        return $this->render('index', [
            'dataProviderAll' => $dataProviderAll,
            'dataProviderClosed' => $dataProviderClosed,
            'dataProviderOverdue' => $dataProviderOverdue,
            'countAll' => $countAll,
            'countClosed' => $countClosed,
            'countOverdue' => $countOverdue,

        ]);
    }
}
