<?php

use \yii\widgets\ActiveForm;
use \yii\helpers\Url;
use \yii\helpers\Html;

/* @var $model \common\models\tables\Tasks */
/* @var $responsible */
/* @var $status */
/* @var $taskCommentForm */
/* @var $userId */
/* @var $taskAttachmentForm */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => Url::to(['task/'])];
$this->params['breadcrumbs'][] = $this->title;

\frontend\assets\TaskAsset::register($this);
?>

<h1><?= Yii::t('task', 'task_card_title') ?> #<?= $model->id ?></h1>
<div class="task-wrapper alert alert-success">
    <div class="task-edit">
        <div class="task-edit-main">
            <?php $form = ActiveForm::begin(['action' => Url::to(['task/save', 'id' => $model->id])]); ?>
            <div class="row">
                <div class="col-md-12"><?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?></div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model->owner, 'username')->textInput(['readonly' => true])->label(Yii::t('task',
                        'task_owner')) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'responsible_id')->dropDownList($responsible,
                        ['prompt' => 'Set responsible']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'status_id')->dropDownList($status) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'date_start')->widget('kartik\date\DatePicker', [
                        'name' => 'date_start',
                        'options' => ['placeholder' => 'Select start date'],
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'format' => 'yyyy-MM-dd',
                            'todayHighlight' => true,
                            'autoclose' => true
                        ]
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'date_end')->widget('kartik\date\DatePicker', [
                        'name' => 'date_end',
                        'options' => ['placeholder' => 'Select finish date'],
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'format' => 'yyyy-MM-dd',
                            'todayHighlight' => true,
                            'autoclose' => true
                        ]
                    ]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12"><?= $form->field($model, 'description')->textarea(['rows' => 6]) ?></div>
            </div>

            <div class="row">
                <div class="col-md-12"><?= Html::submitButton(Yii::t('task', 'task_edit_button'),
                        ['class' => 'btn btn-success']) ?></div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <hr>


    <div class="task-attachments">
        <h3><?= Yii::t('task', 'task_attachments_bloc_title') ?></h3>

        <?php $form = ActiveForm::begin(['action' => Url::to(['task/add-attachment'])]); ?>
        <?= $form->field($taskAttachmentForm, 'taskId')->hiddenInput(['value' => $model->id,])->label(false); ?>
        <?= $form->field($taskAttachmentForm, 'file')->widget(\kartik\file\FileInput::class, [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'showPreview' => false,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false
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

    <div class="task-comments">
        <h3><?= Yii::t('task', 'task_comments_bloc_title') ?></h3>

        <?php $form = ActiveForm::begin([
            'action' => Url::to(['task/add-comment']),
        ]); ?>
        <?= $form->field($taskCommentForm, 'user_id')->hiddenInput(['value' => $userId])->label(false); ?>
        <?= $form->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $model->id])->label(false); ?>
        <div class="row">
            <div class="col-md-10">
                <?= $form->field($taskCommentForm, 'content')->textInput()->label(false); ?>
            </div>
            <div class="col-md-1">
                <?= Html::submitButton(Yii::t('task', 'task_comments_button'),
                    ['class' => 'btn btn-success add-comment-btn']); ?>
            </div>
        </div>
        <? ActiveForm::end() ?>

        <div class="task-comments-history">
            <? if ($model->taskComments): ?>
                <? foreach ($model->taskComments as $comment): ?>
                    <p><strong><?= $comment->user->username ?></strong>: <?= $comment->content ?></p>
                <?php endforeach; ?>
            <? else: ?>
                <p><?= Yii::t('task', 'task_comments_bloc_history') ?></p>
            <? endif; ?>
        </div>
    </div>
    <hr>


    <div class="alert alert-warning task-chat" role="alert">
        <h3><?= Yii::t('task', 'task_chat_title') ?></h3>

        <div class="row">
            <div class="col-md-4 task-chat-form-div">
                <form action="#" name="task-chat-form" id="task-chat-form">
                    <div class="form-inline">
                        <input type="hidden" name="channel" value="<?= 'Task_' . $model->id ?>"/>
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