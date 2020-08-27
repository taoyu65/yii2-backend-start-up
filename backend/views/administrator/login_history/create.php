<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AdministratorLoginHistory */

$this->title = 'Create Administrator Login History';
$this->params['breadcrumbs'][] = ['label' => 'Administrator Login Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrator-login-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
