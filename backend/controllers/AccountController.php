<?php
namespace backend\controllers;

use backend\forms\administrator\AdministratorLoginForm;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class AccountController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'blank';

        if (!\Yii::$app->user->isGuest) {
            $url = $this->getFirstPermission(Yii::$app->user->id);
            if ($url) {
                return $this->redirect($url);
            }
        }

        $model = new AdministratorLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $auth = Yii::$app->authManager;
            $userId = Yii::$app->user->id;
            $permission = '/site/index';
            $havePermission = $auth->checkAccess($userId, $permission);
            if ($havePermission) {
                return $this->redirect($permission);
            } else {
                $url = $this->getFirstPermission($userId);
                if ($url) {
                    return $this->redirect($url);
                } else {
                    return $this->goHome();
                }
            }
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @param $userId
     * @return string|null
     */
    private function getFirstPermission($userId)
    {
        $getPermission = Yii::$app->authManager->getPermissionsByUser($userId);
        if ($getPermission) {
            return array_keys($getPermission)[0];
        }

        return null;
    }
}
