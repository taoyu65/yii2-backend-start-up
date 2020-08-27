<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AdministratorOperationLog */

$this->title = 'Create Administrator Operation Log';
$this->params['breadcrumbs'][] = ['label' => 'Administrator Operation Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrator-operation-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
