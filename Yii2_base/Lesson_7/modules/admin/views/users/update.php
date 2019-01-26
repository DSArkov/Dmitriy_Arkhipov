<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Users */
/* @var $role */

$this->title = 'Update user: ' . $model->id;
$this->params['breadcrumbs'][] = 'Admin';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['/admin/users/']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'role' => $role
    ]) ?>

</div>
