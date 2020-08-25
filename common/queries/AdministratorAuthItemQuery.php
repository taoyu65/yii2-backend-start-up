<?php

namespace common\queries;

use common\models\AdministratorAuthItem;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\AdministratorAuthItem]].
 *
 * @see \common\models\AdministratorAuthItem
 */
class AdministratorAuthItemQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return AdministratorAuthItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AdministratorAuthItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }


    /**
     * @param $name
     * @return AdministratorAuthItemQuery
     */
    public function byName($name)
    {
        return $this->andWhere(['name' => $name]);
    }

    /**
     * @param $isAbleLog
     * @return AdministratorAuthItemQuery
     */
    public function byIsAbleLog($isAbleLog)
    {
        return $this->andWhere(['is_able_lob' => $isAbleLog]);
    }
}
