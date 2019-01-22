<?php

use yii\db\Migration;

/**
 * Class m181227_122307_add_tasks_users_fk
 */
class m181227_122307_add_tasks_users_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk_tasks_owner_users',
            'tasks',
            'owner_id',
            'users',
            'id'
        );

        $this->addForeignKey(
            'fk_tasks_responsible_users',
            'tasks',
            'responsible_id',
            'users',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_tasks_owner_users',
            'tasks'
        );

        $this->dropForeignKey(
            'fk_tasks_responsible_users',
            'tasks'
        );
    }
}
