<?php
namespace backend\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'index',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => [
                            'error',
                            'captcha',
                        ],
                        'allow' => true,
                    ],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_DEV === 'dev' ? 'testMe' : null,
                'maxLength'=>4,
                'minLength'=>4,
                'width' => 100,
                'height' => 40,
                'padding' => 0, // padding around the text
                'foreColor'=>0x21A1E1,
                'transparent' => true,
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->redirect(['index']);
    }
}