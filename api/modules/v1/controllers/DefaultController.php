<?php

namespace api\modules\v1\controllers;

use common\models\User;
use Yii;
use yii\filters\VerbFilter;
use api\modules\v1\controllers\BaseController as Controller;

/**
 * Default controller for the `v1` module
 */
class DefaultController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'deploy' => ['POST'],
                    'key' => []
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return json_encode(['status' => true, 'swapsy-message' => 'yes,good22']);
    }
}
