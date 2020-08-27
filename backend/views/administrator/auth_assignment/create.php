<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AdministratorAuthAssignment */

$this->title = 'Create Administrator Auth Assignment';
$this->params['breadcrumbs'][] = ['label' => 'Administrator Auth Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrator-auth-assignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
