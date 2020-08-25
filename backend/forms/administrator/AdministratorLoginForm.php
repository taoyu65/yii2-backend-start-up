<?php
namespace backend\forms\administrator;

use common\models\Administrator;
use Yii;
use yii\base\Model;

class AdministratorLoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;

    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['verifyCode', 'captcha'],

            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verify Code',
            'username' => 'Username',
            'password' => 'Password',
            'rememberMe' => 'Remember Me',
        ];
    }

    /**
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * @return Administrator|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Administrator::findByUsername($this->username);
        }

        return $this->_user;
    }
}
