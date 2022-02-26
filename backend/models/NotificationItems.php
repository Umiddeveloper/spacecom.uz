<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "notification_items".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $notification_id
 * @property int|null $status
 *
 * @property User $user
 */
class NotificationItems extends ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_VIEWED = 1;

    public static function tableName()
    {
        return 'notification_items';
    }

    public function rules()
    {
        return [
            [['user_id', 'status'], 'integer'],
            [['status'], 'default', 'value' => self::STATUS_NEW],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['notification_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notifications::class, 'targetAttribute' => ['notification_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'notification_id' => Yii::t('app', 'Notification ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getNotification()
    {
        return $this->hasOne(Notifications::class, ['id' => 'notification_id']);
    }

    public function viewed()
    {
        $this->status = self::STATUS_VIEWED;
        $this->save();
    }

    public static function getStatus()
    {
        return [
            self::STATUS_NEW => Yii::t('app', 'New Notification Item'),
            self::STATUS_VIEWED => Yii::t('app', 'Viewed Notification Item'),
        ];
    }

    public static function getNotifications($user_id)
    {
        return NotificationItems::find()
            ->where([
                'notification_items.user_id' => $user_id,
                'notification_items.status' => NotificationItems::STATUS_NEW,
                'notifications.status' => Notifications::STATUS_ACTIVE
            ])
            ->joinWith(['notification'])
            ->orderBy(['notifications.created_at' => SORT_DESC])
            ->asArray()
            ->all();
    }

}
