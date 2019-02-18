<?php

//Регистрируем класс в пространстве имён.
namespace frontend\controllers;

//Импортируем классы.
use frontend\models\forms\TaskAttachmentsAddForm;
use common\models\tables\TaskComments;
use common\models\tables\TaskStatuses;
use common\models\tables\User;
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
            'taskAttachmentForm' => new TaskAttachmentsAddForm(),
            'channel' => 'Task_' . $id,
        ]);
    }

    /**
     * Метод создаёт новую задачу.
     * Если успех, то происходит редирект на страницу просмотра.
     * @throws ForbiddenHttpException
     * @return mixed
     */
    public function actionCreate()
    {
        $projectId = Yii::$app->request->get('id_project');

        if (!\Yii::$app->user->can('TaskCreate')) {
            throw new ForbiddenHttpException();
        }

        $model = new Tasks();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['task', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'responsible' => User::getUsersList(),
            'status' => TaskStatuses::getStatusesList(),
            'userId' => \Yii::$app->user->id,
            'projectId' => $projectId
        ]);
    }

    /**
     * Метод сохраняет изменения после редактирования задачи(Pjax).
     * @param int $id - Идентификатор задачи.
     * @throws ForbiddenHttpException
     * @return string - Возвращает строку с данными для вывода на экран.
     */
    public function actionSave($id)
    {
        if (!\Yii::$app->user->can('TaskEdit')) {
            throw new ForbiddenHttpException();
        }

        $model = Tasks::findOne($id);
        $model->load(\Yii::$app->request->post());
        $model->save();

        return $this->render('_form', [
            'model' => Tasks::findOne($id),
            'owner' => User::getUsersList(),
            'responsible' => User::getUsersList(),
            'status' => TaskStatuses::getStatusesList(),
        ]);
    }

    /**
     * Метод добавляет вложение к задаче.
     * @throws \yii\base\Exception
     */
    public function actionAddAttachment()
    {
        if (!\Yii::$app->user->can('TaskAddFile')) {
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

    /**
     * Метод добавляет комментарий к задаче(Pjax).
     * @throws ForbiddenHttpException
     * @return string - Возвращает строку с данными для вывода на экран.
     */
    public function actionAddComment()
    {
        if (!\Yii::$app->user->can('TaskAddComment')) {
            throw new ForbiddenHttpException();
        }

        $model = new TaskComments();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $id = $model->task_id;
            return $this->render('_comments', [
                'model' => Tasks::findOne($id),
                'userId' => \Yii::$app->user->id,
                'taskCommentForm' => new TaskComments()
            ]);
        }
    }
}