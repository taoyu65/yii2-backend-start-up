<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\searches\AdministratorOperationLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administrator Operation Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="administrator-operation-log-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => '',
        'columns' => [
            'id',
            'admin_id',
            'action',
            'index',
            'logged_user_id',
            'create_time:datetime',
        ],
    ]); ?>
</div>