<?php

namespace backend\widgets;

use backend\models\NotificationItems;
use backend\models\Notifications;

class NotificationWidget extends \yii\base\Widget
{
    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    public function run()
    {
        $notifications = NotificationItems::getNotifications(\Yii::$app->user->identity->id);
        $count = count($notifications);
        array_splice($notifications, 5);
        return $this->render('notifications', [
            'count' => $count,
            'notifications' => $notifications
        ]);
    }

}