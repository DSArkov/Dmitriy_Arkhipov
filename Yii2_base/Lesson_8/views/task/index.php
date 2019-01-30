<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;

$items = [
    '1' => 'January',
    '2' => 'February',
    '3' => 'March',
    '4' => 'April',
    '5' => 'May',
    '6' => 'June',
    '7' => 'July',
    '8' => 'August',
    '9' => 'September',
    '10' => 'October',
    '11' => 'November',
    '12' => 'December'
];
$params = [
    'prompt' => 'Select month',
    'class' => 'form-control',
    'id' => 'select-month'
];

\app\assets\TaskListAsset::register($this);
?>


<h1><?= Html::encode($this->title) ?></h1>

<div class="row task-buttons-row">
    <div class="col-md-9">
        <a href="<?= Url::to(['task/create']) ?>" class="btn btn-primary">Create task</a>
    </div>

    <div class="col-md-3">
        <?php $form = ActiveForm::begin(); ?>
        <div class="form-inline">
            <div class="form-group">
                <?= Html::dropDownList('month', 'null', $items, $params); ?>
            </div>
            <?= Html::submitButton('Ok', ['class' => 'btn btn-primary', 'name' => 'month-filter-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>


<?= \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => function ($model) {
        return app\widgets\Task::widget(['model' => $model]);
    },
    'summary' => false,
    'options' => [
        'class' => 'preview-container'
    ]
]); ?>

