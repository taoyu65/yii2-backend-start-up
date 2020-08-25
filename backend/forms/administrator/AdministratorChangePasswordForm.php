<?php
namespace backend\forms\administrator;

use common\models\Administrator;
use Yii;
use yii\base\Model;
use yii\web\ForbiddenHttpException;

class AdministratorChangePasswordForm extends Model
{
    public $old_password;
    public $new_password;
    public $new_password_repeat;

    /* @var Administrator|null */
    private $_user;

    /**
     * @param array $config
     * @throws ForbiddenHttpException
     */
    public function __construct($config = [])
    {
        if(Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException('Please login first');
        }
        $this->_user = Administrator::findOne(Yii::$app->user->id);
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_password', 'new_password', 'new_password_repeat'], 'required', 'message'=>'Please provide {attribute}'],
            [['new_password', 'new_password_repeat'], 'string', 'min'=>6, 'max'=>128],
            ['new_password_repeat', 'compare', 'compareAttribute'=>'new_password'],
            ['old_password', 'validatePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'old_password' => 'Old Password',
            'new_password' => 'New Password',
            'new_password_repeat' => 'New Password Again',
        ];
    }

    /**
     * @param string $attribute
     * @param array $params
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ( !$this->_user || !$this->_user->validatePassword($this->old_password) ) {
                $this->addError($attribute, 'Wrong Password');
            }
        }
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function changePassword()
    {
        $user = $this->_user;
        $user->setPassword($this->new_password);
        return $user->save();
    }
}
