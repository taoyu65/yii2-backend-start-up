<?php

namespace common\queries;

/**
 * This is the ActiveQuery class for [[\common\models\AdministratorAuthItemChild]].
 *
 * @see \common\models\AdministratorAuthItemChild
 */
class AdministratorAuthItemChildQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\AdministratorAuthItemChild[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\AdministratorAuthItemChild|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
