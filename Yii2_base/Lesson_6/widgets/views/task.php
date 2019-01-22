<?php

//Используем класс.
use yii\helpers\Url;

/** @var $model \app\models\tables\Tasks */

$this->title = 'Tasks';
?>

<div class="task-container">
    <a class="task-link" href="<?= Url::to(['task/task', 'id' => $model->id]) ?>">
        <h4><?= $model->title ?></h4>

        <div class="task-preview">
            <div>Статус: <?= $model->status ?></div>
            <div>Дата создания: <?= $model->created_at ?></div>
            <div>Исполнитель: <?= $model->responsible->login ?></div>
        </div>
    </a>
</div>