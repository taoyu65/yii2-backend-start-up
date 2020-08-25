<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "administrator_auth_item_child".
 *
 * @property string $parent
 * @property string $child
 *
 * @property AdministratorAuthItem $parent0
 * @property AdministratorAuthItem $child0
 */
class AdministratorAuthItemChild extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'administrator_auth_item_child';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['parent', 'child'], 'unique', 'targetAttribute' => ['parent', 'child']],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => AdministratorAuthItem::className(), 'targetAttribute' => ['parent' => 'name']],
            [['child'], 'exist', 'skipOnError' => true, 'targetClass' => AdministratorAuthItem::className(), 'targetAttribute' => ['child' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'parent' => 'Parent',
            'child' => 'Child',
        ];
    }

    /**
     * Gets query for [[Parent0]].
     *
     * @return \yii\db\ActiveQuery|\common\queries\AdministratorAuthItemQuery
     */
    public function getParent0()
    {
        return $this->hasOne(AdministratorAuthItem::className(), ['name' => 'parent']);
    }

    /**
     * Gets query for [[Child0]].
     *
     * @return \yii\db\ActiveQuery|\common\queries\AdministratorAuthItemQuery
     */
    public function getChild0()
    {
        return $this->hasOne(AdministratorAuthItem::className(), ['name' => 'child']);
    }

    /**
     * {@inheritdoc}
     * @return \common\queries\AdministratorAuthItemChildQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\queries\AdministratorAuthItemChildQuery(get_called_class());
    }
}
