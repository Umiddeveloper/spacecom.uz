<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $phone
 * @property string $full_name
 * @property string $auth_key
 * @property integer $status
 * @property integer $chat_id
 * @property integer $role
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $new_password;
    public $password;

    public $role;

    public static function tableName()
    {
        return '{{%user}}';
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
            [['email', 'full_name', 'username'], 'required'],
            [['email', 'username', 'chat_id'], 'unique'],
            [['status'], 'integer'],
            [['password'], 'required', 'when' => function ($model) {
                return $model->isNewRecord;
            }],
            [['username', 'email', 'full_name', 'phone', 'password', 'new_password', 'role'], 'string', 'max' => 255],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'full_name' => Yii::t('app', 'Full Name'),
            'username' => Yii::t('app', 'User Name'),
            'phone' => Yii::t('app', 'User Phone'),
            'chat_id' => Yii::t('app', 'Telegram ID'),
            'password' => Yii::t('app', 'Password'),
            'new_password' => Yii::t('app', 'New Password'),
            'status' => Yii::t('app', 'Status'),
            'role' => Yii::t('app', 'Role'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->generateAuthKey();
            $this->setPassword($this->password);
        }
        if (isset($this->new_password) && $this->new_password != '') {
            $this->setPassword($this->new_password);
        }

        return parent::beforeSave($insert);
    }


    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $auth = Yii::$app->authManager;
            $role = $auth->getRole('user');
            $auth->assign($role, $this->id);
        }

        if ($this->role) {
            $auth = Yii::$app->authManager;
            $role = $auth->getRole($this->role);
            $auth->revokeAll($this->id);
            $auth->assign($role, $this->id);
        }

        parent::afterSave($insert, $changedAttributes);
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->role = isset(array_keys(Yii::$app->authManager->getRolesByUser($this->id))[0]) ? array_keys(Yii::$app->authManager->getRolesByUser($this->id))[0] : null;
    }

    public static function makeModerator($user)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole('moderator');
        $auth->revokeAll($user->id);
        $auth->assign($role, $user->id);
    }

    public static function removeModerator($user)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole('user');
        $auth->revokeAll($user->id);
        $auth->assign($role, $user->id);
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token)
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function getRoleList($action = 'create')
    {
        $roles = array_keys(Yii::$app->authManager->getRoles());
        $role_list = [];
        if (!Yii::$app->user->can('admin') && $action == 'create') {
            unset($roles[0]);
        }
        foreach ($roles as $role) {
            $role_list[$role] = Yii::t('app', ucfirst($role) . ' Role');
        }
        return $role_list;
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'User Status Active'),
            self::STATUS_INACTIVE => Yii::t('app', 'User Status InActive'),
            self::STATUS_DELETED => Yii::t('app', 'User Status Deleted'),
        ];
    }
}
