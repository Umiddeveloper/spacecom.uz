<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notification_items}}`.
 */
class m210811_133724_create_notification_items_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%notification_items}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'notification_id' => $this->integer(),
            'status' => $this->boolean(),
        ]);


        $this->createIndex('{{%idx-notification_items-user_id}}', '{{%notification_items}}', 'user_id');
        $this->addForeignKey('{{%fk-notification_items-user_id}}', '{{%notification_items}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');

        $this->createIndex('{{%idx-notification_items-notification_id}}', '{{%notification_items}}', 'notification_id');
        $this->addForeignKey('{{%fk-notification_items-notification_id}}', '{{%notification_items}}', 'notification_id', '{{%notifications}}', 'id', 'CASCADE', 'RESTRICT');

    }

    public function safeDown()
    {
        $this->dropTable('{{%notification_items}}');
    }
}
