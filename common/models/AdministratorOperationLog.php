<?php

namespace common\models;

use common\queries\AdministratorOperationLogQuery;
use Exception;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "administrator_operation_log".
 *
 * @property int $id
 * @property int|null $admin_id
 * @property string|null $action
 * @property string|null $index
 * @property int|null $create_time
 * @property int|null $logged_user_id
 */
class AdministratorOperationLog extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%administrator_operation_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['admin_id', 'create_time', 'logged_user_id'], 'integer'],
            [['action', 'index'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_id' => 'Admin ID',
            'action' => 'Action',
            'index' => 'Index',
            'create_time' => 'Create Time',
            'logged_user_id' => 'Logged User ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return AdministratorOperationLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AdministratorOperationLogQuery(get_called_class());
    }


    /**
     * @param $adminId
     * @param $action
     * @param $index
     * @param $loggedUserId
     * @throws Exception
     */
    public static function createLog($adminId, $action, $index, $loggedUserId)
    {
        $time = time();
        $sql = 'insert into ' . self::tableName() . " (`admin_id`, `action`, `index`, `create_time`, `logged_user_id`) values ($adminId, '$action', '$index', $time, $loggedUserId);";
        if (!Yii::$app->db->createCommand($sql)->execute()) {
            throw new Exception('Save operation log error.');
        }
    }
}
