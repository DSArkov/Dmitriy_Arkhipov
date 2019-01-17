<?php

//Используем класс.
use yii\helpers\Url;

/** @var $model \app\models\tables\Tasks */
?>

<div class="task-container">
    <a class="task-link" href="<?= Url::to(['task/task', 'id' => $model->id]) ?>">
        <h4><?= $model->title ?></h4>

        <div class="task-preview">
            <div>Статус:</span> <?= $model->status ?></div>
            <div>Дата создания:</span> <?= $model->created_at ?></div>
            <div>Исполнитель:</span> <?= $model->responsible->login ?></div>
        </div>
    </a>
</div>