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
        $model = Tasks::findOne($id);
        $taskClass = 'alert alert-success';
        if (($model->date_end < date('Y-m-d')) && ($model->status_id != 7)) {
            $taskClass = 'alert alert-danger';
        }

        return $this->render('task', [
            'model' => $model,
            'owner' => User::getUsersList(),
            'responsible' => User::getUsersList(),
            'status' => TaskStatuses::getStatusesList(),
            'userId' => \Yii::$app->user->id,
            'taskCommentForm' => new TaskComments(),
            'taskAttachmentForm' => new TaskAttachmentsAddForm(),
            'channel' => 'Task_' . $id,
            'taskClass' => $taskClass
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
        $model = Tasks::findOne($id);
        if (\Yii::$app->user->can('admin') || \Yii::$app->user->id == $model->responsible_id) {
            $model->load(\Yii::$app->request->post());
            $model->save();

            return $this->render('_form', [
                'model' => $model,
                'responsible' => User::getUsersList(),
                'status' => TaskStatuses::getStatusesList(),
            ]);
        }
        throw new ForbiddenHttpException();
    }

    /**
     * Метод добавляет вложение к задаче.
     * @throws \yii\base\Exception
     */
    public function actionAddAttachment()
    {
        $post = \Yii::$app->request->post();
        $taskId = $post['TaskAttachmentsAddForm']['taskId'];
        $task = Tasks::findOne($taskId);

        if (\Yii::$app->user->can('admin') || \Yii::$app->user->id == $task->responsible_id) {
            $model = new TaskAttachmentsAddForm();
            $model->load($post);
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->save()) {
                \Yii::$app->session->setFlash('success', Yii::t('task', 'task_attachment_message_success'));
            } else {
                \Yii::$app->session->setFlash('error', Yii::t('task', 'task_attachment_message_error'));
            }

            $this->redirect(\Yii::$app->request->referrer);
        } else {
            throw new ForbiddenHttpException();
        }
    }

    /**
     * Метод добавляет комментарий к задаче(Pjax).
     * @throws ForbiddenHttpException
     * @return string - Возвращает строку с данными для вывода на экран.
     */
    public function actionAddComment()
    {
        $post = \Yii::$app->request->post();
        $taskId = $post['TaskComments']['task_id'];
        $userId = \Yii::$app->user->id;
        $task = Tasks::findOne($taskId);

        if (\Yii::$app->user->can('admin') || $userId == $task->responsible_id) {
            $model = new TaskComments();

            if ($model->load($post) && $model->save()) {
                return $this->render('_comments', [
                    'model' => $task,
                    'userId' => $userId,
                    'taskCommentForm' => new TaskComments()
                ]);
            }
        }
        throw new ForbiddenHttpException();
    }
}