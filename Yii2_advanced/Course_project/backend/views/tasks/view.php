<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Tasks */
/* @var $owner */

$this->title = $model->title;
$this->params['breadcrumbs'][] = 'Admin';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['/admin/tasks']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'owner_id',
            'responsible_id',
            'status_id',
            'created_at',
            'date_start',
            'date_end',
            'description:text',
            'updated_at'
        ],
    ]) ?>

</div>
