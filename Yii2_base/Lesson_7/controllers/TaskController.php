<?php

//Регистрируем класс в пространстве имён.
namespace app\controllers;


//Импортируем классы.
use app\models\forms\TaskAttachmentsAddForm;
use app\models\tables\TaskComments;
use app\models\tables\TaskStatuses;
use app\models\tables\Users;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\tables\Tasks;
use Yii;
use yii\web\UploadedFile;

//Контроллер задач.
class TaskController extends Controller
{
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
            'owner' => Users::getUsersList(),
            'responsible' => Users::getUsersList(),
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
            'responsible' => Users::getUsersList(),
            'status' => TaskStatuses::getStatusesList(),
            'userId' => \Yii::$app->user->id,
        ]);
    }

    /**
     * Метод сохраняет изменения после редактирования задачи.
     * @param int $id - Идентификатор задачи.
     */
    public function actionSave($id)
    {
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
     */
    public function actionAddComment()
    {
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