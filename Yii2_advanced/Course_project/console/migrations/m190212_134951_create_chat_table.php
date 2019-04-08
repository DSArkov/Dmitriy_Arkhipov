<?php

use yii\db\Migration;


/**
 * Handles the creation of table `chat`.
 */
class m190212_134951_create_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chat', [
            'id' => $this->primaryKey(),
            'channel' => $this->string(),
            'message' => $this->string(),
            'user_id' => $this->integer(),
            'created_at' => $this->dateTime()
        ]);

        $this->addForeignKey(
            'fk_chat_user',
            'chat',
            'user_id',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_chat_user',
            'chat'
        );

        $this->dropTable('chat');
    }
}
