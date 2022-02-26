<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\base\Model;

class EditProfileForm extends Model
{
    public $full_name;
    public $email;
    public $username;
    public $phone;
    public $password;
    public $password_repeat;

    private $user;

    public function __construct($config = [])
    {
        $user = Yii::$app->user->identity;
        $this->user = $user;
        $this->full_name = $user->full_name;
        $this->username = $user->username;
        $this->phone = $user->phone;
        $this->email = $user->email;
        parent::__construct($config);
    }

    public function attributeLabels()
    {
        return [
            'full_name' => Yii::t('app', 'Full Name'),
            'username' => Yii::t('app', 'User Name'),
            'email' => Yii::t('app', 'User Email'),
            'phone' => Yii::t('app', 'User Phone'),
            'password' => Yii::t('app', 'Password'),
            'password_repeat' => Yii::t('app', 'Repeat Password'),
        ];
    }

    public function rules()
    {
        return [
            [['full_name', 'email', 'username'], 'required'],
            [
                'username', 'unique', 'targetClass' => '\common\models\User', 'when' => function ($model) {
                    $model->username != $model->user->username;
                }
            ],
            [
                'username', 'unique', 'targetClass' => '\common\models\User', 'when' => function ($model) {
                    $model->email != $model->user->email;
                }
            ],
            [['phone', 'username', 'email'], 'string', 'max' => 255],
            [['email'], 'trim'],
            [['email'], 'email'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['password_repeat', 'compare', 'compareAttribute' => 'password',]
        ];
    }

    public function save()
    {
        $user = User::findOne(Yii::$app->user->identity->id);
        if ($this->email != $user->email) {
            $user->email = $this->email;
            $user->generateEmailVerificationToken();
//            $user->generateAuthKey();
        }
        $user->phone = $this->phone;
        $user->username = $this->username;
        $user->full_name = $this->full_name;
        if (isset($this->password) && $this->password != '') {
            $user->setPassword($user->password);
        }
        return $user->save();
    }
}