<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%users}}`.
 */
class m210810_062556_add_chat_id_column_to_users_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'role', $this->tinyInteger());
        $this->addColumn('{{%user}}', 'chat_id', $this->bigInteger());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%users}}', 'role');
        $this->dropColumn('{{%users}}', 'chat_id');
    }
}
