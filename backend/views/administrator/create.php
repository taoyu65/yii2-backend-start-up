<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Administrator */

$this->title = 'Create Administrator';
$this->params['breadcrumbs'][] = ['label' => 'Administrators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrator-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
