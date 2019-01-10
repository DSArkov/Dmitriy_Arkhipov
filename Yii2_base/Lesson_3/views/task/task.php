<?php /* @var $task */ ?>

<h1><?= $task->title ?></h1>
<p>Назначил: <?= $task->owner_id ?></p>
<p>Исполнитель: <?= $task->owner_id ?></p>
<p>Статус задачи: <?= $task->status ?></p>
<p>Дата создания: <?= $task->date ?></p>
<p>Дата начала: <?= $task->date_start ?></p>
<p>Дата завершения: <?= $task->date_end ?></p>
<p>Описание: <?= $task->description ?></p>