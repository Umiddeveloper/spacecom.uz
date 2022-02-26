<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notifications}}`.
 */
class m210810_062908_create_notifications_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%notifications}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'message' => $this->text(),
            'status' => $this->tinyInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex('{{%idx-notifications-user_id}}', '{{%notifications}}', 'user_id');
        $this->addForeignKey('{{%fk-notifications-user_id}}', '{{%notifications}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%notifications}}');
    }
}
