<?php

/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <h1><?= \yii\helpers\Html::encode($this->title) ?></h1>

    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'tasksList'
    ]); ?>
</div>
