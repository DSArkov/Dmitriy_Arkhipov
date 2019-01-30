<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task_statuses`.
 */
class m190123_082150_create_task_statuses_table extends Migration
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

        $this->dropColumn($this->tasksTable, 'status');
        $this->addColumn($this->tasksTable, 'status_id', $this->integer());
        $this->addForeignKey('fk_task_statuses', $this->tasksTable, 'status_id', $this->statusTable, 'id');

        $this->batchInsert($this->statusTable, ['title'], [
            ['Новая'],
            ['Аналитика'],
            ['В работе'],
            ['Выполнена'],
            ['Тестирование'],
            ['Доработка'],
            ['Закрыта']
        ]);

        $this->update($this->tasksTable, ['status_id' => 1]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_task_statuses',
            'tasks'
        );

        $this->dropColumn($this->tasksTable, 'status_id');
        $this->addColumn($this->tasksTable, 'status', $this->$this->string(32)->notNull());

        $this->dropTable($this->statusTable);
    }
}
