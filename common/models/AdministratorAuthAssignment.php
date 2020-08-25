<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "administrator_auth_assignment".
 *
 * @property string $item_name
 * @property string $user_id
 * @property int|null $created_at
 *
 * @property AdministratorAuthItem $itemName
 */
class AdministratorAuthAssignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'administrator_auth_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['created_at'], 'integer'],
            [['item_name', 'user_id'], 'string', 'max' => 64],
            [['item_name', 'user_id'], 'unique', 'targetAttribute' => ['item_name', 'user_id']],
            [['item_name'], 'exist', 'skipOnError' => true, 'targetClass' => AdministratorAuthItem::className(), 'targetAttribute' => ['item_name' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_name' => 'Item Name',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[ItemName]].
     *
     * @return \yii\db\ActiveQuery|\common\queries\AdministratorAuthItemQuery
     */
    public function getItemName()
    {
        return $this->hasOne(AdministratorAuthItem::className(), ['name' => 'item_name']);
    }

    /**
     * {@inheritdoc}
     * @return \common\queries\AdministratorAuthAssignmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\queries\AdministratorAuthAssignmentQuery(get_called_class());
    }
}
