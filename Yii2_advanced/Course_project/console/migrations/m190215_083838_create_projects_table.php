<?php

use yii\db\Migration;

/**
 * Handles the creation of table `projects`.
 */
class m190215_083838_create_projects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('projects', [
            'id' => $this->primaryKey(),
            'title' => $this->text()->notNull(),
            'description' => $this->text(),
            'created_at' => $this->dateTime()
        ]);

        $this->addColumn('tasks', 'project_id', $this->integer());

        $this->addForeignKey(
            'fk_tasks_projects',
            'tasks',
            'project_id',
            'projects',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_tasks_projects',
            'tasks'
        );

        $this->dropColumn('tasks', 'project_id');

        $this->dropTable('projects');
    }
}
