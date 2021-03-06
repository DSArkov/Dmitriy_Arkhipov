<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tasks`.
 */
class m181222_180524_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('tasks', [
            'id' => $this->primaryKey(),
            'title' => $this->string(64)->notNull(),
            'owner_id' => $this->integer()->notNull(),
            'responsible_id' => $this->integer(),
            'status' => $this->string(32)->notNull(),
            'date' => $this->dateTime()->notNull(),
            'date_start' => $this->date(),
            'date_end' => $this->date(),
            'description' => $this->text()
        ]);

        $this->createIndex('index_tasks_owner', 'tasks', 'owner_id');

        $this->createIndex('index_tasks_responsible', 'tasks', 'responsible_id');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('tasks');
    }
}
