<?php

use yii\db\Migration;


/**
 * Handles the creation of table `telegram_subscribe`.
 */
class m190218_112602_create_telegram_subscribe_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('telegram_subscribe', [
            'id' => $this->primaryKey(),
            'chat_id' => $this->integer(),
            'channel' => $this->string()
        ]);

        $this->createIndex('chat_id_channel_index', 'telegram_subscribe', ['chat_id', 'channel'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('chat_id_channel_index', 'telegram_subscribe');

        $this->dropTable('telegram_subscribe');
    }
}
