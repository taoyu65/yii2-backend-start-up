<?php
namespace backend\forms\administrator;

use common\models\Administrator;
use yii\base\Model;
use Exception;

class AdministratorForm extends Model
{
    public $username;
    public $email;
    public $password;

    /* @var Administrator */
    private $_administrator;

    /**
     * @var boolean
     */
    public $isNewRecord;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 3, 'max' => 45],
            ['username', 'unique', 'targetClass'=>Administrator::class, 'when'=>function(self $model) { return $model->isNewRecord;}, 'message'=>'用户名已存在'],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => Administrator::class, 'when'=>function(self $model) { return $model->isNewRecord;}, 'message' => 'email已存在'],

            ['password', 'required', 'when'=>function(self $model) { return $model->isNewRecord;}],
            ['password', 'string', 'min'=>6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    public function setAdministrator(Administrator $administrator)
    {
        $this->_administrator = $administrator;
        $this->username = $administrator->username;
        $this->email = $administrator->email;
    }


    /**
     * @return Administrator
     */
    public function getAdministrator()
    {
        return $this->_administrator;
    }


    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function create()
    {
        if ( ! $this->validate()) {
            return false;
        }

        $administrator = new Administrator;
        $administrator->username = $this->username;
        $administrator->email = $this->email;
        $administrator->email_verified = true;
        $administrator->setPassword($this->password);
        $administrator->generateAuthKey();
        if($administrator->save()) {
            $this->setAdministrator($administrator);
            return true;
        }

        return false;
    }


    /**
     * @return boolean
     * @throws Exception
     */
    public function update()
    {
        if (!$this->validate()) {
            return false;
        }

        $administrator = $this->_administrator;
        $administrator->username = $this->username;
        $administrator->email = $this->email;
        if($this->password) {
            $administrator->setPassword($this->password);
        }
        return $administrator->save();
    }
}
