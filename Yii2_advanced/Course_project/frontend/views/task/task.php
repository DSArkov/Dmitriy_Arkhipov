<?php

use \yii\widgets\ActiveForm;
use \yii\helpers\Url;

/* @var $model \common\models\tables\Tasks */
/* @var $owner */
/* @var $responsible */
/* @var $status */
/* @var $taskCommentForm */
/* @var $userId */
/* @var $taskAttachmentForm */
/* @var $channel */
/* @var $taskClass */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('task', 'task_breadcrumb_project'), 'url' => Url::to(['project/'])];
$this->params['breadcrumbs'][] = ['label' => $model->project_id, 'url' => Url::to(['project/project', 'id' => $model->project_id])];
$this->params['breadcrumbs'][] = Yii::t('task', 'task_card_title') . ' ' . $model->id;

\frontend\assets\TaskAsset::register($this);
?>

<h1><?= Yii::t('task', 'task_card_title') ?> #<?= $model->id ?></h1>

<div class="task-wrapper <?= $taskClass ?>">
    <?=
    $this->render('_form', [
        'model' => $model,
        'owner' => $owner,
        'responsible' => $responsible,
        'status' => $status,
    ]);
    ?>


    <div class="task-attachments">
        <h3><?= Yii::t('task', 'task_attachments_bloc_title') ?></h3>

        <?php $form = ActiveForm::begin([
            'action' => Url::to(['task/add-attachment']),
        ]);
        ?>
        <?= $form->field($taskAttachmentForm, 'taskId')->hiddenInput(['value' => $model->id,])->label(false); ?>
        <?= $form->field($taskAttachmentForm, 'file')->widget(\kartik\file\FileInput::class, [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'showPreview' => false,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => true,
            ]
        ])->label(false); ?>
        <? ActiveForm::end() ?>
        <br>

        <div class="attachments-history">
            <? foreach ($model->taskAttachments as $file): ?>
                <a href="/img/tasks/<?= $file->path ?>">
                    <img src="/img/tasks/small/<?= $file->path ?>" alt="img_sm">
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <hr>


    <?=
    $this->render('_comments', [
        'model' => $model,
        'userId' => $userId,
        'taskCommentForm' => $taskCommentForm
    ]);
    ?>


    <div class="alert alert-warning task-chat" role="alert">
        <h3><?= Yii::t('task', 'task_chat_title') ?></h3>

        <div class="row">
            <div class="col-md-4 task-chat-form-div">
                <form action="#" name="task-chat-form" id="task-chat-form">
                    <div class="form-inline">
                        <input type="hidden" name="channel" value="<?= $channel ?>"/>
                        <input type="hidden" name="user_id" value="<?= $userId ?>"/>
                        <input type="text" name="message" id="task-chat-form-input" class="form-control"
                               placeholder="<?= Yii::t('task', 'task_chat_input_value') ?>"/>
                        <button type="submit" class="btn btn-success">></button>
                    </div>
                </form>
            </div>

            <div class="col-md-8">
                <div id="task-chat-div">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let channel = '<?= $channel ?>'
</script>