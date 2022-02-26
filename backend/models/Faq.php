<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "faq".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $question
 * @property string|null $answer
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $user
 */
class Faq extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_NEW = 1;
    const STATUS_PUBLIC = 2;

    const SCEANARIO_DEFAULT = 'default';
    const SCEANARIO_NEW = 'new';
    const SCEANARIO_REPLY = 'reply';

    public function scenarios()
    {
        return [
            self::SCEANARIO_DEFAULT => ['user_id', 'status', 'question', 'answer'],
            self::SCEANARIO_NEW => ['user_id', 'status', 'question'],
            self::SCEANARIO_REPLY => ['user_id', 'status', 'question', 'answer'],
        ];
    }

    public static function tableName()
    {
        return 'faq';
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
            [['question'], 'required', 'on' => self::SCEANARIO_NEW],
            [['question', 'answer'], 'required', 'on' => self::SCEANARIO_REPLY],
            [['question', 'answer'], 'required', 'when' => function ($model) {
                return $model->status == self::STATUS_PUBLIC;
            }],
            [['user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['status'], 'default', 'value' => self::STATUS_DRAFT],
            [['question', 'answer'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'question' => Yii::t('app', 'Question'),
            'answer' => Yii::t('app', 'Answer'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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

    public static function getStatus()
    {
        return [
            self::STATUS_DRAFT => Yii::t('app', 'Draft'),
            self::STATUS_NEW => Yii::t('app', 'New Faq'),
            self::STATUS_PUBLIC => Yii::t('app', 'Public'),
        ];
    }

    public function reply()
    {
        if (!$this->validate())
            return false;
        $this->status = Faq::STATUS_DRAFT;
        $this->save();
        $user = $this->user;
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'faqReply-html', 'text' => 'faqReply-text'],
                [
                    'faq' => $this,
                    'user' => $user
                ]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($user->email)
            ->setSubject('Answer from your question in ' . Yii::$app->name)
            ->send();
    }
}
