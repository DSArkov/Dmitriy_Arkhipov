<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m181222_183800_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'login' => $this->string(16)->notNull(),
            'password' => $this->string(32)->notNull(),
            'email' => $this->string(32)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('users');
    }
}
