<?php

namespace backend\components\rbac;

class DbManager extends \yii\rbac\DbManager
{
    /**
     * @var string
     */
    public $itemTable = '{{%administrator_auth_item}}';
    /**
     * @var string
     */
    public $itemChildTable = '{{%administrator_auth_item_child}}';
    /**
     * @var string
     */
    public $assignmentTable = '{{%administrator_auth_assignment}}';
    /**
     * @var string
     */
    public $ruleTable = '{{%administrator_auth_rule}}';
}