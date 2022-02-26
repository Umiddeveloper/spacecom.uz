<?php

namespace common\models;


use himiklab\yii2\recaptcha\ReCaptchaValidator2;
use Yii;
use yii\db\ActiveRecord;

class Feedback extends ActiveRecord
{
    public $reCaptcha;
    public $full_name;
    public $email_phone;
    public $message;

    public function rules()
    {
        return [
            [['full_name', 'email_phone'], 'required'],
            [['full_name', 'email_phone', 'message'], 'string', 'max' => 200],
            [['reCaptcha'], ReCaptchaValidator2::class, 'uncheckedMessage' => Yii::t('app', 'Please confirm that you are not a bot.')],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'full_name' => Yii::t('app', 'Name'),
            'email_phone' => Yii::t('app', 'Phone'),
            'message' => Yii::t('app', 'Message'),
            'created_at' => Yii::t('app', 'Created at'),
            'reCaptcha' => Yii::t('app', 'reCaptcha'),
        ];
    }
}
