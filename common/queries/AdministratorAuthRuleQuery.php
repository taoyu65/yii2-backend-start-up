<?php

namespace common\queries;

/**
 * This is the ActiveQuery class for [[\common\models\AdministratorAuthRule]].
 *
 * @see \common\models\AdministratorAuthRule
 */
class AdministratorAuthRuleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\AdministratorAuthRule[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\AdministratorAuthRule|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
