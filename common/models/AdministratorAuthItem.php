<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "administrator_auth_item".
 *
 * @property string $name
 * @property int $type
 * @property string|null $description
 * @property string|null $rule_name
 * @property resource|null $data
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $is_able_log
 *
 * @property AdministratorAuthAssignment[] $administratorAuthAssignments
 * @property AdministratorAuthRule $ruleName
 * @property AdministratorAuthItemChild[] $administratorAuthItemChildren
 * @property AdministratorAuthItemChild[] $administratorAuthItemChildren0
 * @property AdministratorAuthItem[] $children
 * @property AdministratorAuthItem[] $parents
 */
class AdministratorAuthItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'administrator_auth_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at', 'is_able_log'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['name'], 'unique'],
            [['rule_name'], 'exist', 'skipOnError' => true, 'targetClass' => AdministratorAuthRule::className(), 'targetAttribute' => ['rule_name' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
            'rule_name' => 'Rule Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_able_log' => 'Is Able Log',
        ];
    }

    /**
     * Gets query for [[AdministratorAuthAssignments]].
     *
     * @return \yii\db\ActiveQuery|\common\queries\AdministratorAuthAssignmentQuery
     */
    public function getAdministratorAuthAssignments()
    {
        return $this->hasMany(AdministratorAuthAssignment::className(), ['item_name' => 'name']);
    }

    /**
     * Gets query for [[RuleName]].
     *
     * @return \yii\db\ActiveQuery|\common\queries\AdministratorAuthRuleQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(AdministratorAuthRule::className(), ['name' => 'rule_name']);
    }

    /**
     * Gets query for [[AdministratorAuthItemChildren]].
     *
     * @return \yii\db\ActiveQuery|\common\queries\AdministratorAuthItemChildQuery
     */
    public function getAdministratorAuthItemChildren()
    {
        return $this->hasMany(AdministratorAuthItemChild::className(), ['parent' => 'name']);
    }

    /**
     * Gets query for [[AdministratorAuthItemChildren0]].
     *
     * @return \yii\db\ActiveQuery|\common\queries\AdministratorAuthItemChildQuery
     */
    public function getAdministratorAuthItemChildren0()
    {
        return $this->hasMany(AdministratorAuthItemChild::className(), ['child' => 'name']);
    }

    /**
     * Gets query for [[Children]].
     *
     * @return \yii\db\ActiveQuery|\common\queries\AdministratorAuthItemQuery
     */
    public function getChildren()
    {
        return $this->hasMany(AdministratorAuthItem::className(), ['name' => 'child'])->viaTable('administrator_auth_item_child', ['parent' => 'name']);
    }

    /**
     * Gets query for [[Parents]].
     *
     * @return \yii\db\ActiveQuery|\common\queries\AdministratorAuthItemQuery
     */
    public function getParents()
    {
        return $this->hasMany(AdministratorAuthItem::className(), ['name' => 'parent'])->viaTable('administrator_auth_item_child', ['child' => 'name']);
    }

    /**
     * {@inheritdoc}
     * @return \common\queries\AdministratorAuthItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\queries\AdministratorAuthItemQuery(get_called_class());
    }
}
