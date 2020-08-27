<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AdministratorLoginHistory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="administrator-login-history-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'administrator_id')->textInput() ?>

    <?= $form->field($model, 'login_time')->textInput() ?>

    <?= $form->field($model, 'login_ip')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
