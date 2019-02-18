<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tasks`.
 */
class m190202_144609_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('tasks', [
            'id' => $this->primaryKey(),
            'title' => $this->text()->notNull(),
            'owner_id' => $this->integer()->notNull(),
            'responsible_id' => $this->integer(),
            'status_id' => $this->integer()->notNull(),
            'date_start' => $this->date(),
            'date_end' => $this->date(),
            'description' => $this->text(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);

        $this->addForeignKey(
            'fk_tasks_owner_user',
            'tasks',
            'owner_id',
            'user',
            'id'
        );

        $this->addForeignKey(
            'fk_tasks_responsible_user',
            'tasks',
            'responsible_id',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk_tasks_owner_user',
            'tasks'
        );

        $this->dropForeignKey(
            'fk_tasks_responsible_user',
            'tasks'
        );

        $this->dropTable('tasks');
    }
}
