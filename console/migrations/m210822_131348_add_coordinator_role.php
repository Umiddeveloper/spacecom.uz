<?php

use yii\db\Migration;

/**
 * Class m210822_131348_add_coordinator_role
 */
class m210822_131348_add_coordinator_role extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $user = $auth->getRole('user');
        $coordinator = $auth->createRole('coordinator');
        $auth->add($coordinator);
        $auth->addChild($coordinator, $user);
    }

    public function safeDown()
    {
        return true;
    }

}
