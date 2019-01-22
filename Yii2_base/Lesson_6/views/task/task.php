<?php

/* @var $task */

$this->title = $task->id;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url'=> 'index.php?r=task'];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Задание #<?= $task->id ?></h1>
<p>Название: <?= $task->title ?></p>
<p>Назначил: <?= $task->owner->login ?></p>
<p>Исполнитель: <?= $task->responsible->login ?></p>
<p>Статус задачи: <?= $task->status->title ?></p>
<p>Дата создания: <?= $task->created_at ?></p>
<p>Дата начала: <?= $task->date_start ?></p>
<p>Дата завершения: <?= $task->date_end ?></p>
<p>Описание: <?= $task->description ?></p>