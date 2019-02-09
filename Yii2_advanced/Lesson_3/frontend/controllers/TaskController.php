<?php

//Регистрируем класс в пространстве имён.
namespace frontend\controllers;

//Импортируем классы.
use frontend\models\forms\TaskAttachmentsAddForm;
use common\models\tables\TaskComments;
use common\models\tables\TaskStatuses;
use common\models\tables\User;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\tables\Tasks;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;


//Контроллер задач.
class TaskController extends Controller
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
     * Основной метод(по умолчанию), отображает список задач.
     * @return string - Возвращает строку с данными для вывода на экран.
     */
    public function actionIndex()
    {
        $month = \Yii::$app->request->post('month');

        if ($month) {
            $query = Tasks::find()->where("MONTH(created_at) = {$month}");
        } else {
            $query = Tasks::find();
        }

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query
            ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * Метод отображает карточку задачи.
     * @param int $id - Идентификатор задачи.
     * @return string - Возвращает строку с данными для вывода на экран.
     */
    public function actionTask($id)
    {
        return $this->render('task', [
            'model' => Tasks::findOne($id),
            'owner' => User::getUsersList(),
            'responsible' => User::getUsersList(),
            'status' => TaskStatuses::getStatusesList(),
            'userId' => \Yii::$app->user->id,
            'taskCommentForm' => new TaskComments(),
            'taskAttachmentForm' => new TaskAttachmentsAddForm()
        ]);
    }

    /**
     * Метод создаёт новую задачу.
     * Если успех, то происходит редирект на страницу просмотра.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tasks();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['task', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'responsible' => User::getUsersList(),
            'status' => TaskStatuses::getStatusesList(),
            'userId' => \Yii::$app->user->id,
        ]);
    }

    /**
     * Метод сохраняет изменения после редактирования задачи.
     * @param int $id - Идентификатор задачи.
     * @throws ForbiddenHttpException
     */
    public function actionSave($id)
    {
        if (!\Yii::$app->user->can('TaskAddComment') || !\Yii::$app->user->can('TaskAddFile')) {
            throw new ForbiddenHttpException();
        }

        if ($model = Tasks::findOne($id)) {
            $model->load(\Yii::$app->request->post());
            $model->save();
            \Yii::$app->session->setFlash('success', "The changes was save.");
        } else {
            \Yii::$app->session->setFlash('error', "Somewhere an error, check please...");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Метод добавляет комментарий к задаче.
     * @throws ForbiddenHttpException
     */
    public function actionAddComment()
    {
        if (!\Yii::$app->user->can('TaskAddComment') || !\Yii::$app->user->can('TaskAddFile')) {
            throw new ForbiddenHttpException();
        }

        $model = new TaskComments();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', Yii::t('task', 'task_comment_message_success'));
        } else {
            \Yii::$app->session->setFlash('error', Yii::t('task', 'task_comment_message_error'));
        }
        $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Метод добавляет вложение к задаче.
     * @throws \yii\base\Exception
     */
    public function actionAddAttachment()
    {
        if (!\Yii::$app->user->can('TaskAddComment') || !\Yii::$app->user->can('TaskAddFile')) {
            throw new ForbiddenHttpException();
        }

        $model = new TaskAttachmentsAddForm();
        $model->load(\Yii::$app->request->post());
        $model->file = UploadedFile::getInstance($model, 'file');
        if($model->save()){
            \Yii::$app->session->setFlash('success', Yii::t('task', 'task_attachment_message_success'));
        }else {
            \Yii::$app->session->setFlash('error', Yii::t('task', 'task_attachment_message_error'));
        }
        $this->redirect(\Yii::$app->request->referrer);
    }
}