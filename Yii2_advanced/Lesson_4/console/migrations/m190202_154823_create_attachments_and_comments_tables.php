<?php

use yii\db\Migration;

/**
 * Class m190202_154823_create_attachments_and_comments_tables
 */
class m190202_154823_create_attachments_and_comments_tables extends Migration
{
    protected $commentsTable = 'task_comments';

    protected $attachmentsTable = 'task_attachments';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->commentsTable, [
            'id' => $this->primaryKey(),
            'content' => $this->string(),
            'task_id' => $this->integer(),
            'user_id' => $this->integer()
        ]);
        $this->addForeignKey('fk_comments_tasks', $this->commentsTable, 'task_id', 'tasks', 'id');
        $this->addForeignKey('fk_comments_user', $this->commentsTable, 'user_id', 'user', 'id');

        $this->createTable($this->attachmentsTable, [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(),
            'path' => $this->string()
        ]);
        $this->addForeignKey('fk_attachments_tasks', $this->attachmentsTable, 'task_id', 'tasks', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_attachments_tasks',
            $this->attachmentsTable
        );
        $this->dropTable($this->attachmentsTable);

        $this->dropForeignKey(
            'fk_comments_user',
            $this->commentsTable
        );
        $this->dropForeignKey(
            'fk_comments_tasks',
            $this->commentsTable
        );
        $this->dropTable($this->commentsTable);
    }
}
