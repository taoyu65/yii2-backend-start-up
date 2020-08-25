<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "administrator_auth_rule".
 *
 * @property string $name
 * @property resource|null $data
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property AdministratorAuthItem[] $administratorAuthItems
 */
class AdministratorAuthRule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'administrator_auth_rule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[AdministratorAuthItems]].
     *
     * @return \yii\db\ActiveQuery|\common\queries\AdministratorAuthItemQuery
     */
    public function getAdministratorAuthItems()
    {
        return $this->hasMany(AdministratorAuthItem::className(), ['rule_name' => 'name']);
    }

    /**
     * {@inheritdoc}
     * @return \common\queries\AdministratorAuthRuleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\queries\AdministratorAuthRuleQuery(get_called_class());
    }
}
