<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;
use yii\console\controllers\MigrateController;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class RbacController extends Controller
{

    public function actionInit()
    {
        $migration = new MigrateController('migrate', Yii::$app);
        $migration->runAction('up', ['migrationPath' => '@yii/rbac/migrations/', 'interactive' => false]);

        $auth = Yii::$app->authManager;

        $user = $auth->createRole('user');
        $auth->add($user);

        $moderator = $auth->createRole('moderator');
        $auth->add($moderator);
        $auth->addChild($moderator, $user);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $moderator);

        $permUpdateProfile = $auth->createPermission('perm_update-profile');
        $permUpdateProfile->description = 'Разрешение для обновления Профиля';
    }

    public function actionAssign()
    {
        $auth = Yii::$app->authManager;
        $username = $this->prompt('Username:', ['required' => true]);
        $user = $this->findModel($username);
        $role = $auth->getRole($this->select('Role:', ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description')));
        $auth->assign($role, $user->id);
        $this->stdout('Done!' . PHP_EOL);
    }

    private function findModel($username): User
    {
        if (!$model = User::findOne(['username' => $username])) {
            throw new Exception('User is not found');
        }
        return $model;
    }
}
