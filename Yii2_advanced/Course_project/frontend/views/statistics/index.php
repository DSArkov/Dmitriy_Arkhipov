<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\filters\TasksSearch */
/* @var $dataProviderAll yii\data\ActiveDataProvider */
/* @var $dataProviderClosed yii\data\ActiveDataProvider */
/* @var $dataProviderOverdue yii\data\ActiveDataProvider */
/* @var $countAll */
/* @var $countClosed */
/* @var $countOverdue */


$this->title = 'Statistics';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <button class="btn btn-primary" data-toggle="collapse" data-target="#collapse-1" aria-expanded="false"
            aria-controls="collapse-1">All tasks
    </button>
    <button class="btn btn-primary" data-toggle="collapse" data-target="#collapse-2" aria-expanded="false"
            aria-controls="collapse-2">Closed last week
    </button>
    <button class="btn btn-primary" data-toggle="collapse" data-target="#collapse-3" aria-expanded="false"
            aria-controls="collapse-3">Overdue
    </button>
</p>

<div class="row">
    <div class="col-sm-6">
        <div class="collapse" id="collapse-1">
            <div class="card card-body">
                <h4>All tasks - <?= $countAll ?></h4>
                <?= \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProviderAll,
                    'summary' => false,
                    'itemView' => '_oneTask',
                    'options' => [
                        'tag' => 'ul',
                        'class' => 'list-group list-group-flush'
                    ],
                    'itemOptions' => [
                        'tag' => false,
                    ],
                ]); ?>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="collapse" id="collapse-2">
            <div class="card card-body">
                <h4>Closed last week - <?= $countClosed ?></h4>
                <?= \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProviderClosed,
                    'summary' => false,
                    'itemView' => '_oneTask',
                    'options' => [
                        'tag' => 'ul',
                        'class' => 'list-group list-group-flush'
                    ],
                    'itemOptions' => [
                        'tag' => false,
                    ],
                ]); ?>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="collapse" id="collapse-3">
            <div class="card card-body">
                <h4>Overdue - <?= $countOverdue ?></h4>
                <?= \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProviderOverdue,
                    'summary' => false,
                    'itemView' => '_oneTask',
                    'options' => [
                        'tag' => 'ul',
                        'class' => 'list-group list-group-flush'
                    ],
                    'itemOptions' => [
                        'tag' => false,
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
