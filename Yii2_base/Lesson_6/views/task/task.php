<?php

use \yii\widgets\ActiveForm;
use \yii\helpers\Url;
use \yii\helpers\Html;

/* @var $model \app\models\tables\Tasks */
/* @var $owner */
/* @var $responsible */
/* @var $status */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => 'index.php?r=task'];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Задание #<?= $model->id ?></h1>

<div class="task-edit">
    <div class="task-edit-main">
        <?php $form = ActiveForm::begin(['action' => Url::to(['task/save', 'id' => $model->id])]); ?>
        <div class="row">
            <div class="col-md-12"><?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?></div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model->owner, 'login')->textInput(['readonly' => true])->label('Owner') ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'responsible_id')->dropDownList($responsible,
                    ['prompt' => 'Set responsible']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'status_id')->dropDownList($status, ['value' => '1']) ?>
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
            <div class="col-md-12"><?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?></div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>


</div>


<!--<p>Название: --><? //= $task->title ?><!--</p>-->
<!--<p>Назначил: --><? //= $task->owner->login ?><!--</p>-->
<!--<p>Исполнитель: --><? //= $task->responsible->login ?><!--</p>-->
<!--<p>Статус задачи: --><? //= $task->status->title ?><!--</p>-->
<!--<p>Дата создания: --><? //= $task->created_at ?><!--</p>-->
<!--<p>Дата начала: --><? //= $task->date_start ?><!--</p>-->
<!--<p>Дата завершения: --><? //= $task->date_end ?><!--</p>-->
<!--<p>Описание: --><? //= $task->description ?><!--</p>-->