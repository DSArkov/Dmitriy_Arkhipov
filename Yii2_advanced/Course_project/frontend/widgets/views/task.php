<?php

//Используем класс.
use yii\helpers\Url;

/* @var $model \common\models\tables\Tasks */
/* @var $taskClass */

$this->title = 'Tasks';
?>

<div class="task-container">
    <a href="<?= Url::to(['task/task', 'id' => $model->id]) ?>" class="task-link <?= $taskClass ?>">

        <h4><?= $model->title ?></h4>

        <div class="task-preview">
            <div>
                Status:
                <!-- Если задача закрыта - выводим статус, дату и выделяем жирным шрифтом -->
                <?php if ($model->status_id == 7): ?>
                    <?= '<strong>' . $model->status->title . ' ' . $model->date_end . '</strong>' ?>
                <!-- Иначе показываем только статус -->
                <?php else: ?>
                    <?= $model->status->title ?>
                <?php endif; ?>
            </div>
            <div>Date create: <?= $model->created_at ?></div>
            <div>Responsible: <?= $model->responsible->username ?></div>
        </div>
    </a>
</div>