<?php
namespace backend\components;

use common\components\utilities\OtherUtility;
use common\models\AdministratorLoginHistory;
use yii\rbac\CheckAccessInterface;
use yii\web\IdentityInterface;
use yii\web\User;

/**
 * @inheritdoc
 *
 * @property \common\models\Administrator | IdentityInterface | null    $identity The identity object associated with the currently logged-in user. null is returned if the user is not logged in (not authenticated).
 */
class Administrator extends User
{
    /**
     * @var CheckAccessInterface The access checker to use for checking access.
     * If not set the application auth manager will be used.
     * @since 2.0.9
     */
    public $accessChecker = 'backend\components\rbac\DbManager';


    /**
     * @param bool|true $autoRenew
     *
     * @return \common\models\User | IdentityInterface
     * @throws \Throwable
     */
    public function getIdentity($autoRenew = true)
    {
        return parent::getIdentity($autoRenew);
    }

    public function afterLogin($identity, $cookieBased, $duration)
    {
        parent::afterLogin($identity, $cookieBased, $duration);

        $this->saveUserLoginHistory();
    }

    protected function saveUserLoginHistory()
    {
        $userLoginHistory = new AdministratorLoginHistory;
        $userLoginHistory->administrator_id = $this->identity->id;
        $userLoginHistory->login_time = time();
        $userLoginHistory->login_ip = ip2long(OtherUtility::getUserRealIp());
        $userLoginHistory->save();
    }

}