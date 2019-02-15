<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\tables\User */

$this->title = 'Create user';
$this->params['breadcrumbs'][] = 'Admin';
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['/admin/user/']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
