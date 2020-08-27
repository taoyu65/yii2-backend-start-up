<?php

namespace backend\controllers;

use backend\forms\administrator\AdministratorChangePasswordForm;
use backend\components\Controller;
use yii;

class AccountOtherController extends Controller
{
    /**
     * @return string|yii\web\Response
     * @throws yii\base\Exception
     */
    public function actionChangePassword()
    {
        $model = new AdministratorChangePasswordForm;
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->changePassword()) {
            Yii::$app->session->setFlash('success', 'Password updated.');
            return $this->refresh();
        } else {
            return $this->render('/account/change-password', [
                'model' => $model
            ]);
        }
    }

    /**
     * @return yii\web\Response
     */
    public function actionSetting()
    {
        return $this->redirect(['administrator/view', 'id' => Yii::$app->user->id]);
    }
}
