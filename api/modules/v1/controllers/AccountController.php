<?php

namespace api\modules\v1\controllers;

use yii\web\Controller;

/**
 * Default controller for the `v1` module
 */
class AccountController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionLogin()
    {
        return json_encode(['status' => true, 'message' => 'yes,good']);
    }
}
