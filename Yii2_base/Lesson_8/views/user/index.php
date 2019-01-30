<?php

//Используем класс.
use yii\helpers\Url;

/* @var $taskList */

$this->title = 'My tasks';
$this->params['breadcrumbs'][] = $this->title;
$counter = 1;
?>

<h1><?= \yii\helpers\Html::encode($this->title) ?></h1>

<?php foreach ($taskList as $task): ?>
    <div>
        <a href="<?= Url::to(['task/task', 'id' => $task->id]) ?>"><h4><?= $counter ?>. <?= $task->title ?></h4></a>
    </div>
<?php
$counter++;
endforeach;
?>