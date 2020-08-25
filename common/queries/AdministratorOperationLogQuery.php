<?php

namespace common\queries;

/**
 * This is the ActiveQuery class for [[\common\models\AdministratorOperationLog]].
 *
 * @see \common\models\AdministratorOperationLog
 */
class AdministratorOperationLogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\AdministratorOperationLog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\AdministratorOperationLog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
