<?php

use yii\BaseYii;

class Yii extends BaseYii
{
    /**
     * @var BaseApplication|WebApplication|ConsoleApplication the application instance
     */
    public static $app;
}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = include(__DIR__ . '/vendor/yiisoft/yii2/classes.php');
Yii::$container = new yii\di\Container;

/**
 * @property yii\db\Connection $db_dev
 */
abstract class BaseApplication extends yii\base\Application
{
}

/**
 * @property backend\components\Administrator $user read-only.
 * @property yii\web\UrlManager $urlManagerFrontend This property is read-only.
 * @property \frontend\components\Controller | \backend\components\Controller $controller read-only.
 * @property \backend\components\rbac\DbManager $backendAuthManager read-only.
 */
class WebApplication extends yii\web\Application
{
}

/**
 * Class ConsoleApplication
 */
class ConsoleApplication extends yii\console\Application
{
}