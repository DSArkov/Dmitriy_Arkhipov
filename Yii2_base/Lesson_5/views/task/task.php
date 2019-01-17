<?php /* @var $task */ ?>

<h1><?= $task->title ?></h1>
<p>Назначил: <?= $task->owner->login ?></p>
<p>Исполнитель: <?= $task->responsible->login ?></p>
<p>Статус задачи: <?= $task->status ?></p>
<p>Дата создания: <?= $task->created_at ?></p>
<p>Дата начала: <?= $task->date_start ?></p>
<p>Дата завершения: <?= $task->date_end ?></p>
<p>Описание: <?= $task->description ?></p>