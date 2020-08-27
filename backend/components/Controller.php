<?php
namespace backend\components;

use common\components\traits\ReturnJsonTrait;
use common\models\AdministratorAuthItem;
use common\models\AdministratorOperationLog;
use Exception;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller as Yii_Controller;

class Controller extends Yii_Controller
{
    use ReturnJsonTrait;

    public $layout = 'main';
    public $currentPage = 1;

    public $useSideBarLayout = true;
    public $firstName = 'Tao';
    public $lastName = 'Yu';

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

        $this->_getAminName();

        return parent::beforeAction($action);
    }

    public function loadMenus()
    {
        $_showMap = $this->_getShowMenuMap();
        return [
            [
                'label' => 'Dashboard',
                'visible' => $this->_isShowParentMenu(['first', 'second'], $_showMap),
                'active' => $this->_isParentActive(['dashboard']),
                'lead' => 'fa fa-tachometer-alt',
                'tail' => '<span class="badge badge-pill badge-success">Pro</span>',
                'child' => [
                    [
                        'label' => 'First',
                        'url' => '/first',
                        'active' => $this->_isParentActive(['first']),
                        'visible' => $this->_isShowMenu('first', $_showMap),
                    ],
                    [
                        'label' => 'Second',
                        'url' => '/second',
                        'active' => $this->_isParentActive(['second']),
                        'visible' => $this->_isShowMenu('second', $_showMap),
                    ],
                ],
            ],
            [
                'label' => 'Permission',
                'url' => '/permission',
                'lead' => 'fa fa-gem',
                'visible' => $this->_isShowMenu('', $_showMap),
                'active' => $this->_isParentActive(['permission']),
                'child' => [],
            ],
        ];
    }

    private function _isParentActive(array $controllerArr, array $actionArr = null)
    {
        if ($actionArr) {
            return in_array(Yii::$app->controller->id, $controllerArr) && in_array(Yii::$app->controller->action->id, $actionArr);
        }

        return in_array(Yii::$app->controller->id, $controllerArr);
    }

    private function _getAminName()
    {
        $this->firstName = Yii::$app->user->identity->first_name;
        $this->lastName = Yii::$app->user->identity->last_name;
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

    private function _getShowMenuMap()
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
     * @param $menu
     * @param array $showMenuMap
     * @return bool
     */
    private function _isShowMenu($menu, $showMenuMap)
    {
        if (isset($showMenuMap[$menu])) {
            return $showMenuMap[$menu];
        }

        return false;
    }

    private function _isShowParentMenu($arr, $showMenuMap)
    {
        foreach ($arr as $item) {
            if ($this->_isShowMenu($item, $showMenuMap)) {
                return true;
            }
        }

        return false;
    }
}
