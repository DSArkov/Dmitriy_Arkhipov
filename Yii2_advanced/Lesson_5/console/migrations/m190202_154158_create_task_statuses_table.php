w<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task_statuses`.
 */
class m190202_154158_create_task_statuses_table extends Migration
{
    protected $statusTable = 'task_statuses';

    protected $tasksTable = 'tasks';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->statusTable, [
            'id' => $this->primaryKey(),
            'title' => $this->string(32)
        ]);

        $this->addForeignKey('fk_tasks_statuses', $this->tasksTable, 'status_id', $this->statusTable, 'id');

        $this->batchInsert($this->statusTable, ['title'], [
            ['Новая'],
            ['Аналитика'],
            ['В работе'],
            ['Выполнена'],
            ['Тестирование'],
            ['Доработка'],
            ['Закрыта']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_tasks_statuses',
            $this->tasksTable
        );

        $this->dropTable($this->statusTable);
    }
}
