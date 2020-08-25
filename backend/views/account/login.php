<?php

/* @var $this yii\web\View */
/* @var $model LoginForm */

use backend\assets\AppAsset;
use common\models\LoginForm;
use yii\bootstrap4\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

AppAsset::register($this);

$this->title = 'LoveSwapsy Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'form-signin']]); ?>
    <h1 class="h3 mb-3 font-weight-normal text-center"><?= Html::encode($this->title) ?></h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username']) ->label(false)?>
    <?= $form->field($model, 'password')->passwordInput()->label(false) ?>
    <?= $form->field($model, 'rememberMe')->checkbox() ?>
    <?= $form->field($model, 'verifyCode', [
        'inputOptions' => [
            'placeholder' => $model->getAttributeLabel('verifyCode'),
        ],
    ])->widget(Captcha::class, [
        'template' => '<div class="row"><div class="col-md-7">{input}</div><div class="col-md-3">{image}</div></div>',
        'options'=>[
            'placeholder' => $model->getAttributeLabel('verifyCode'),
            'class'=>'form-control',
        ],
    ])->label(false) ?>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
<?php ActiveForm::end(); ?>

<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }
    .form-signin .checkbox {
        font-weight: 400;
    }
    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

</style>