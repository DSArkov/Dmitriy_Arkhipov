<?php

use yii\helpers\Url;

/* @var $model \common\models\tables\Tasks */
?>

<li class="list-group-item">
    <a href="<?= Url::to(['task/task', 'id' => $model->id]) ?>">
        <?= $model->title ?>
    </a>
    -
    <?= $model->status->title ?>
</li>
