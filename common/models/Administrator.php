<?php

namespace common\models;

use common\queries\AdministratorLoginHistoryQuery;
use common\queries\AdministratorQuery;
use Exception;
use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "administrator".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $username
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property int $email_verified
 * @property int $role
 * @property int $status
 * @property int $avatar_count
 * @property string|null $password_reset_token
 * @property int|null $last_visit_time
 * @property int $create_time
 * @property int $update_time
 *
 * @property AdministratorLoginHistory[] $administratorLoginHistories
 */
class Administrator extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%administrator}}';
    }

    public static function adminIds()
    {
        return [
            1
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'email_verified', 'role', 'status', 'avatar_count', 'last_visit_time', 'create_time', 'update_time'], 'integer'],
            [['role', 'status', 'avatar_count', 'create_time', 'update_time'], 'required'],
            [['username', 'first_name', 'last_name', 'password_hash', 'email', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'email' => 'Email',
            'email_verified' => 'Email Verified',
            'role' => 'Role',
            'status' => 'Status',
            'avatar_count' => 'Avatar Count',
            'password_reset_token' => 'Password Reset Token',
            'last_visit_time' => 'Last Visit Time',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }

    /**
     * Gets query for [[AdministratorLoginHistories]].
     *
     * @return ActiveQuery|AdministratorLoginHistoryQuery
     */
    public function getAdministratorLoginHistories()
    {
        return $this->hasMany(AdministratorLoginHistory::className(), ['administrator_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return AdministratorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AdministratorQuery(get_called_class());
    }

    /**
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @param string $password
     * @return boolean
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public static function findIdentity($id)
    {
        return self::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
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
     * @param string $password
     * @throws Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @throws Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @throws Exception
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }


    /**
     * @return bool|string
     */
    public function getCreateTime()
    {
        return date('Y-m-d H:i:s', $this->create_time);
    }


    /**
     * @return bool|string
     */
    public function getUpdateTime()
    {
        return date('Y-m-d H:i:s', $this->update_time);
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getFullNameOrUsername()
    {
        return $this->getFullName() ?: $this->username;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        $name = '';
        $name .= $this->first_name;
        $name .=' ';
        $name .= $this->last_name;
        return ucwords(trim($name));
    }

    public function isAdmin()
    {
        return in_array($this->id, self::adminIds());
    }
}
