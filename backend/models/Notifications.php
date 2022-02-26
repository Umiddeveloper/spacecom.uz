<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "notifications".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $message
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $user
 */
class Notifications extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 0;

    public static function tableName()
    {
        return 'notifications';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules()
    {
        return [
            [['message'],'required'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['user_id', 'status'], 'integer'],
            [['message'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'message' => Yii::t('app', 'Message'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($insert){
            $this->saveNotification();
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function saveNotification()
    {
        $moderators = User::find()
            ->select('user.*')
            ->leftJoin('auth_assignment', "auth_assignment.user_id = user.id")
            ->andWhere(['auth_assignment.item_name'=>'moderator'])
            ->all();

        $ids = ArrayHelper::map($moderators, 'id', 'chat_id');

        foreach ($ids as $id=>$chat_id) {

            if(isset($chat_id))
                $this->sendMessage(strip_tags($this->message), $chat_id);

            $notification = new NotificationItems();
            $notification->user_id = $id;
            $notification->notification_id = $this->id;
            $notification->save();

        }
    }

    public function sendMessage($message, $chat_id)
    {
        $token = Yii::$app->params['botToken'];
        $post = [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => True,
        ];
        $url = 'https://api.telegram.org/bot'.$token.'/sendMessage';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
//        dd($response);
    }

    public static function getStatus()
    {
        return [
            self::STATUS_DRAFT => Yii::t('app', 'Drafting Notification'),
            self::STATUS_ACTIVE => Yii::t('app', 'Active Notification'),
        ];
    }
    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
