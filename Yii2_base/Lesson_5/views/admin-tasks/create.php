<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */
/* @var $responsible */
/* @var $owner */

$this->title = 'Create Task';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'responsible' => $responsible,
        'owner' => $owner
    ]) ?>

</div>
