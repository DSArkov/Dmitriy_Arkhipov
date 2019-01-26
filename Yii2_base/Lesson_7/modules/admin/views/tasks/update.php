<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */
/* @var $responsible */
/* @var $owner */
/* @var $status */

$this->title = 'Update task: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['/admin/tasks']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tasks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'responsible' => $responsible,
        'status' => $status
    ]) ?>

</div>
