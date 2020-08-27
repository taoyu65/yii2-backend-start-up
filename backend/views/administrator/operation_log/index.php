<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\searches\AdministratorOperationLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administrator Operation Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrator-operation-log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Administrator Operation Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'admin_id',
            'action',
            'index',
            'create_time:datetime',
            //'logged_user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
