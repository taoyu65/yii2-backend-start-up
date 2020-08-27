<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AdministratorAuthItemChild */

$this->title = 'Create Administrator Auth Item Child';
$this->params['breadcrumbs'][] = ['label' => 'Administrator Auth Item Children', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrator-auth-item-child-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
