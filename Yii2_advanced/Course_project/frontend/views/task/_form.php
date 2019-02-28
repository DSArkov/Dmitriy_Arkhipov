<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $model \common\models\tables\Tasks */
/* @var $responsible */
/* @var $status */
?>


<div class="task-edit">
    <?php Pjax::begin([
        'enablePushState' => false,
        'id' => 'task_form'
    ]) ?>
    <?php $form = ActiveForm::begin([
        'action' => Url::to(['task/save', 'id' => $model->id]),
        'options' => ['data' => ['pjax' => true]],
    ]); ?>
    <div class="row">
        <div class="col-md-12"><?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model->owner, 'username')->textInput(['readonly' => true])->label(Yii::t('task',
                'task_owner')) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'responsible_id')->dropDownList($responsible,
                ['prompt' => 'Set responsible']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status_id')->dropDownList($status) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model->project, 'title')->textInput(['readonly' => true])->label(Yii::t('task',
                'task_project')) ?>
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
        <div class="col-md-12"><?= Html::submitButton(Yii::t('task', 'task_form_button'),
                ['class' => 'btn btn-success']) ?></div>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end() ?>
</div>
<hr>
