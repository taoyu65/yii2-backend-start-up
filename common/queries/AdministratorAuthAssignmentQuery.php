<?php

namespace common\queries;

/**
 * This is the ActiveQuery class for [[\common\models\AdministratorAuthAssignment]].
 *
 * @see \common\models\AdministratorAuthAssignment
 */
class AdministratorAuthAssignmentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\AdministratorAuthAssignment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\AdministratorAuthAssignment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
