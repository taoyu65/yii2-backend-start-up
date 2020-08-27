<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AdministratorAuthItem */

$this->title = 'Update Administrator Auth Item: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Administrator Auth Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="administrator-auth-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
