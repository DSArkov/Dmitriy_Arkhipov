<?php

/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= \yii\helpers\Html::encode($this->title) ?></h1>

<button class="task-create btn btn-primary btn-lg">Create task</button>

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
