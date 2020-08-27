<?php

namespace backend\controllers;

use common\models\Administrator;
use common\models\AdministratorAuthItem;
use backend\components\Controller;
use common\searches\AdministratorOperationLogSearch;
use Exception;
use yii\db\StaleObjectException;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use Yii;

/*
 * [▼
  "admin" => array:34 [▼
    "account" => array:2 [▼
      0 => array:2 [▼
        "name" => "change-password"
        "isChecked" => true
      ]
      1 => array:2 [▼
        "name" => "setting"
        "isChecked" => true
      ]
    ]
 */
class PermissionController extends Controller
{
    const ADMIN = 'admin';

    public function actionIndex()
    {
        $roleName = Yii::$app->request->get('r');
        if (!$roleName) {
            $roleName = self::ADMIN;
        }
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        $rolePermission = $this->roleToPermission($roleName);
        $userNames = [];
        $admins = Administrator::find()
            ->asArray()
            ->all();
        foreach ($admins as $admin) {
            $userNames[$admin['id']] = $admin['username'];
        }
        $userList = $auth->getUserIdsByRole($roleName);

        return $this->render('/permission/index', [
            'admin' => self::ADMIN,
            'roleNames' => array_keys($roles),
            'rolePermission' => $rolePermission['roleToPermission'],
            'cbList' => $rolePermission['cbList'],
            'allList' => $rolePermission['allList'],
            'currentRole' => $roleName,
            'userNames' => $userNames,
            'userList' => $userList,
        ]);
    }

    /**
     * @throws Exception
     */
    public function actionUpdatePermission()
    {
        $role = Yii::$app->request->post('role');
        $permission = Yii::$app->request->post('permission') ?: [];
        $auth = Yii::$app->authManager;
        $oldPermission = array_keys($auth->getPermissionsByRole($role));

        $deletePermission = array_diff($oldPermission, $permission);
        $addPermission = array_diff($permission, $oldPermission);

        foreach ($deletePermission as $permission) {
            $auth->removeChild($auth->getRole($role), $auth->getPermission($permission));
        }
        foreach ($addPermission as $permission) {
            $auth->addChild($auth->getRole($role), $auth->getPermission($permission));
        }
    }

    /**
     * @throws Exception
     */
    public function actionAddUser()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $addAdminId = Yii::$app->request->post('adminId');
        $role = Yii::$app->request->post('role');
        if ($addAdminId) {
            $isExist = Administrator::findOne($addAdminId);
            if ($isExist) {
                $auth = Yii::$app->authManager;
                $roleIds = $auth->getUserIdsByRole($role);
                if (!in_array($addAdminId, $roleIds)) {
                    $auth->assign($auth->getRole($role), $addAdminId);
                    return $this->returnStatus();
                }
            }
        }

        return $this->returnStatus(false);
    }

    /**
     * @return array
     * @throws BadRequestHttpException
     */
    public function actionRemoveUser()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $deleteAdminId = Yii::$app->request->post('adminId');
        if(in_array(intval($deleteAdminId), Administrator::adminIds())) {
            throw new BadRequestHttpException;
        }
        $role = Yii::$app->request->post('role');
        if ($deleteAdminId) {
            $auth = Yii::$app->authManager;
            $userRole = $auth->getRole($role);
            $isSuccess = $auth->revoke($userRole, $deleteAdminId);
            return $this->returnStatus($isSuccess);
        }

        return $this->returnStatus(false);
    }

    /**
     * @return array
     */
    public function actionAddPermission()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $permissionName = Yii::$app->request->post('permissionName');
        $detailArr = explode('/', $permissionName);
        if (count($detailArr) !== 2) {
            return $this->returnStatus(false);
        }
        $controllerName = $detailArr[0];

        $auth = Yii::$app->authManager;
        $permission = $auth->createPermission($permissionName);
        $permission->description = $controllerName;
        try {
            $addPermission = $auth->add($permission);
            $addChild = $auth->addChild($auth->getRole(self::ADMIN), $auth->getPermission($permissionName));
            return $this->returnStatus($addPermission && $addChild);
        } catch (Exception $exception) {
            return $this->returnStatus(false);
        }
    }

    /**
     * @return array
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionRemovePermission()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $permissionName = Yii::$app->request->post('permissionName');
        $detailArr = explode('/', $permissionName);
        if (count($detailArr) !== 2) {
            return $this->returnStatus(false);
        }
        $removePermission = AdministratorAuthItem::find()
            ->byName($permissionName)
            ->one();
        if ($removePermission) {
            $isRemoved = $removePermission->delete();
            return $this->returnStatus($isRemoved);
        }

        return $this->returnStatus(false);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function actionAddRole()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $roleName = Yii::$app->request->post('roleName');
        if ($roleName && $roleName !== self::ADMIN) {
            $auth = Yii::$app->authManager;
            $existRoles = array_keys($auth->getRoles());
            if (!in_array($roleName, $existRoles)) {
                $newRole = $auth->createRole($roleName);
                $addRole = $auth->add($newRole);
                if ($addRole) {
                    return $this->returnStatus();
                }
            }
        }

        return $this->returnStatus(false);
    }

    /**
     * @return array
     */
    public function actionRemoveRole()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $roleName = Yii::$app->request->post('roleName');
        if ($roleName && $roleName !== self::ADMIN) {
            $auth = Yii::$app->authManager;
            $removeRole = $auth->remove($auth->getRole($roleName));
            return $this->returnStatus($removeRole);
        }

        return $this->returnStatus(false);
    }

    /**
     * @return array
     */
    public function actionAbleLog()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $name = Yii::$app->request->post('name');
        $item = AdministratorAuthItem::find()
            ->byName($name)
            ->one();
        if ($item) {
            $item->is_able_log = $item->is_able_log === 1 ? 0 : 1;
            return $this->setReturn($item->save(), '', ['isAbleLog' => $item->is_able_log]);
        }

        return $this->setReturn(false);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function actionLog()
    {
        if (!Yii::$app->user->identity->isAdmin()) {
            throw new Exception('Bad Request.');
        }
        $searchModel = new AdministratorOperationLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('log/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $roleName
     * @return array
     */
    private function roleToPermission($roleName)
    {
        $auth = Yii::$app->authManager;
        $re = [];
        $cbList = [];
        $allList = [];

        # admin
        $admin = $auth->getPermissionsByRole(self::ADMIN);

        $re[$roleName] = [];
        $rolePermissions = $auth->getPermissionsByRole($roleName);
        $allItems = AdministratorAuthItem::find()
            ->asArray()
            ->all();
        $isAbleLogMap = ArrayHelper::map($allItems, 'name', 'is_able_log');
        foreach ($admin as $permissionName => $permission) {
            $group = $permission->description;
            if (!isset($re[$roleName][$group])) {
                $re[$roleName][$group] = [];
            }
            $name = explode('/', $permissionName)[1];
            $isChecked = $roleName === self::ADMIN ? true : isset($rolePermissions[$permissionName]);
            $isAbleLog = isset($isAbleLogMap[$permissionName]) ? $isAbleLogMap[$permissionName] : 0;
            if ($isChecked) {
                array_push($cbList, $permissionName);
            }
            array_push($allList, $permissionName);
            array_push($re[$roleName][$group], ['name' => $name, 'isChecked' => $isChecked, 'isAbleLog' => $isAbleLog]);
        }

        return [
            'roleToPermission' => $re,
            'cbList' => $cbList,
            'allList' => $allList,
        ];
    }

    /**
     * @param bool $return
     * @return array
     */
    private function returnStatus($return = true)
    {
        return $this->setReturn($return);
    }
}
