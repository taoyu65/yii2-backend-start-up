<?php
use backend\forms\administrator\AdministratorChangePasswordForm;
use yii\web\View;

/* @var $this View */
/* @var $model AdministratorChangePasswordForm */

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = ['label' => Yii::$app->user->identity->username, 'url' => ['administrator/view', 'id'=>Yii::$app->user->identity->id]];
$this->params['breadcrumbs'][] = 'Change Password';
?>

<div class="row">
    <div class="col-xs-12">
        <div class="ibox">
changepass
            </div>

        </div>
    </div>

</div>
