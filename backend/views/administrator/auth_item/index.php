<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\searches\AdministratorAuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administrator Auth Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrator-auth-item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Administrator Auth Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'type',
            'description:ntext',
            'rule_name',
            'data',
            //'created_at',
            //'updated_at',
            //'is_able_log',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
