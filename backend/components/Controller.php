<?php
namespace backend\components;

use common\models\AdministratorAuthItem;
use common\models\AdministratorOperationLog;
use Exception;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller as Yii_Controller;

class Controller extends Yii_Controller
{
    public $layout = 'main';
    public $currentPage = 1;

    public $useSideBarLayout = true;

    /**
     * @param $action
     * @return bool|void
     * @throws BadRequestHttpException
     * @throws Exception
     */
    public function beforeAction($action)
    {
        if( in_array($action->id, ['error','captcha']) ) {
            $this->_getCurrentPage();
            return parent::beforeAction($action);
        }

        $permission = $action->controller->module->requestedRoute;

        if (!Yii::$app->user->can($permission)) {
            Yii::$app->session->setFlash('danger', 'You don\'t have permission.');

            if ($url = Yii::$app->request->referrer) {
                return Yii::$app->controller->redirect($url)->send();
            } else {
                return Yii::$app->controller->redirect("/login")->send();
            }
        } else {
            $this->_saveToLog($permission);
        }

        $this->_getCurrentPage();

        return parent::beforeAction($action);
    }

    public function getShowMenuMap()
    {
        $re = [];
        $userId = Yii::$app->user->id;
        $auth = Yii::$app->authManager;
        $permissions = $auth->getPermissionsByUser($userId);
        foreach ($permissions as $permissionName => $permission) {
            $controller = $permission->description;
            $re[$controller] = true;
        }

        return $re;
    }

    /**
     * @return array|int|mixed
     */
    protected function getPage()
    {
        return $this->currentPage;
    }

    /**
     * @return string
     */
    protected function getQueryString()
    {
        $query = Yii::$app->request->getQueryString();

        return $query;
    }

    private function _getCurrentPage()
    {
        $page = Yii::$app->request->get('page');

        if (!$page) {
            $page = Yii::$app->request->post('page');
        }

        $this->currentPage = $page ? $page : 1;
    }

    /**
     * @param $permission
     * @throws Exception
     */
    private function _saveToLog($permission) {
        $item = AdministratorAuthItem::find()
            ->byName($permission)
            ->one();
        $action = explode('/', $permission)[1];
        $actionFilter = ['create', 'update', 'update-identification-detail'];
        if (in_array($action, $actionFilter) && !$_POST) {
            return;
        }
        if ($item && $item->is_able_log) {
            $loggedUserId = isset($_REQUEST['logged_uid']) ? $_REQUEST['logged_uid'] : 0;
            $loggedUserId = $loggedUserId ? $loggedUserId : 0;
            $adminId = Yii::$app->user->id;
            $arr = explode('/', $permission);
            $action = $arr[0];
            $index = isset($arr[1]) ? $arr[1] : '';
            AdministratorOperationLog::createLog($adminId, $action, $index, $loggedUserId);
        }
    }
}
