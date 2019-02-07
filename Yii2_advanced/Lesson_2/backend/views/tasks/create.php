<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Tasks */
/* @var $responsible */
/* @var $owner */
/* @var $status */

$this->title = 'Create task';
$this->params['breadcrumbs'][] = 'Admin';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['/admin/tasks']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'responsible' => $responsible,
        'owner' => $owner,
        'status' => $status
    ]) ?>

</div>
