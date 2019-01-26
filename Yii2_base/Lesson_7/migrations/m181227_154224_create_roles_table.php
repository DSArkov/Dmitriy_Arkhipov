<?php

use yii\db\Migration;

/**
 * Handles the creation of table `roles`.
 */
class m181227_154224_create_roles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('roles', [
            'id' => $this->primaryKey(),
            'title' => $this->string(16)
        ]);

        $this->addColumn('users', 'role_id', 'INT');

        $this->addForeignKey(
            'fk_users_roles',
            'users',
            'role_id',
            'roles',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('roles');
    }
}
