<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "administrator_login_history".
 *
 * @property int $id
 * @property int $administrator_id
 * @property int $login_time
 * @property string $login_ip
 *
 * @property Administrator $administrator
 */
class AdministratorLoginHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'administrator_login_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['administrator_id', 'login_time'], 'required'],
            [['administrator_id', 'login_time'], 'integer'],
            [['login_ip'], 'string', 'max' => 255],
            [['administrator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Administrator::className(), 'targetAttribute' => ['administrator_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'administrator_id' => 'Administrator ID',
            'login_time' => 'Login Time',
            'login_ip' => 'Login Ip',
        ];
    }

    /**
     * Gets query for [[Administrator]].
     *
     * @return \yii\db\ActiveQuery|\common\queries\AdministratorQuery
     */
    public function getAdministrator()
    {
        return $this->hasOne(Administrator::className(), ['id' => 'administrator_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\queries\AdministratorLoginHistoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\queries\AdministratorLoginHistoryQuery(get_called_class());
    }
}
