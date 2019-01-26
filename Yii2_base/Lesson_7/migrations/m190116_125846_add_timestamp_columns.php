<?php

use yii\db\Migration;

/**
 * Class m190116_125846_add_timestamp_columns
 */
class m190116_125846_add_timestamp_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('tasks', 'date', 'created_at');

        $this->addColumn('tasks', 'updated_at', 'datetime');

        $this->addColumn('users', 'created_at', 'datetime');

        $this->addColumn('users', 'updated_at', 'datetime');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('tasks', 'created_at', 'date');

        $this->dropColumn('tasks', 'updated_at');

        $this->dropColumn('users', 'created_at');

        $this->dropColumn('users', 'updated_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190116_125846_add_timestamp_columns cannot be reverted.\n";

        return false;
    }
    */
}
