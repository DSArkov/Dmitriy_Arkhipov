<?php

use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $model \common\models\tables\Tasks */
/* @var $taskCommentForm */
/* @var $userId */
?>

<div class="task-comments">
    <h3><?= Yii::t('task', 'task_comments_bloc_title') ?></h3>

    <?php Pjax::begin([
        'enablePushState' => false,
        'id' => 'task_comments'
    ]) ?>
    <?php $form = ActiveForm::begin([
        'action' => Url::to(['task/add-comment']),
        'options' => ['data' => ['pjax' => true]],
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
        <?php Pjax::end() ?>
    </div>
</div>
<hr>