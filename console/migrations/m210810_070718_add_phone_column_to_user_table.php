<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m210810_070718_add_phone_column_to_user_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'phone', $this->string());
        $this->addColumn('{{%user}}', 'full_name', $this->string());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'phone');
    }
}
