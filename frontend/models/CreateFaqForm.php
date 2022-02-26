<?php

namespace frontend\models;

use backend\models\Faq;
use Yii;

class CreateFaqForm extends \yii\base\Model
{
    private $_user;
    public $message;

    public function __construct($config = [])
    {
        $this->_user = Yii::$app->user->identity;
    }

    public function rules()
    {
        return [
            [['message'],'filter','filter'=>'\yii\helpers\HtmlPurifier::process'],
            [['message'],'string'],
            [['message'],'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'message' => Yii::t('app','Faq Message')
        ];
    }

    public function save()
    {
        if(!$this->validate())
            return false;

        $faq = new Faq();
        $faq->scenario = Faq::SCEANARIO_NEW;
        $faq->user_id = $this->_user->id;
        $faq->question = $this->message;
        $faq->status = Faq::STATUS_NEW;
        return $faq->save();
    }
}