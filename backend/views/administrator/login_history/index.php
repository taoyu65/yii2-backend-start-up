<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\searches\AdministratorLoginHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administrator Login Histories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrator-login-history-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Administrator Login History', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'administrator_id',
            'login_time:datetime',
            'login_ip',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
