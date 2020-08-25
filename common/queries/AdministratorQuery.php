<?php

namespace common\queries;

use common\models\Administrator;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\Administrator]].
 *
 * @see \common\models\Administrator
 */
class AdministratorQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Administrator[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Administrator|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
