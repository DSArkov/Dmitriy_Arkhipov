<?php

//Регистрируем класс в пространстве имён.
namespace frontend\controllers;

//Импортируем классы.
use common\models\tables\Tasks;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use common\models\tables\Projects;


/**
 * Class ProjectController
 * @package frontend\controllers
 */
class ProjectController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Основной метод(по умолчанию), отображает список проектов.
     * @return string - Возвращает строку с данными для вывода на экран.
     */
    public function actionIndex()
    {
        $query = Projects::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * Метод создаёт новый проект.
     * Если успех, то происходит редирект на страницу просмотра задач в текущем проекте.
     * @throws ForbiddenHttpException
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (!\Yii::$app->user->can('ProjectCreate')) {
            throw new ForbiddenHttpException();
        }

        $model = new Projects();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['project', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Метод отображает карточку проекта.
     * @param int $id - Идентификатор проекта.
     * @return string - Возвращает строку с данными для вывода на экран.
     */
    public function actionProject($id)
    {
        $month = \Yii::$app->request->post('month');

        if ($month) {
            $query = Tasks::find()->where(['project_id' => $id, 'MONTH(created_at)' => $month]);
        } else {
            $query = Tasks::find()->where(['project_id' => $id]);
        }

        $project = Projects::findOne(['id' => $id]);
        $projectTitle = $project->title;

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query
            ]);

        return $this->render('project', [
            'dataProvider' => $dataProvider,
            'projectTitle' => $projectTitle,
            'projectId' => $id
        ]);
    }
}