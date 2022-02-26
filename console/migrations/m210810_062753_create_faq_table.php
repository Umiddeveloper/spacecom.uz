<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%faq}}`.
 */
class m210810_062753_create_faq_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%faq}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'question' => $this->text(),
            'answer' => $this->text(),
            'status' => $this->tinyInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex('{{%idx-faq-user_id}}', '{{%faq}}', 'user_id');
        $this->addForeignKey('{{%fk-faq-user_id}}', '{{%faq}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%faq}}');
    }
}
