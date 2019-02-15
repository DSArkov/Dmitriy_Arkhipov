<?php

//Используем класс.
use yii\helpers\Url;

/* @var $model \common\models\tables\Projects */
/* @var $tasksCount */
?>

<div class="project-container">
    <a class="project-link alert alert-info" href="<?= Url::to(['project/project', 'id' => $model->id]) ?>">
        <h4><?= $model->title ?></h4>

        <div><b>Date create:</b> <?= $model->created_at ?></div>
        <div><b>Number of tasks:</b> <?= $tasksCount ?></div>
        <hr>
        <div><b>Description:</b> <?= $model->description ?></div>
    </a>
</div>