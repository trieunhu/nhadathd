<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\config\models\FeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fees';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
    <?= Html::a('Create Fee', ['create'], ['class' => 'btn btn-success']) ?>
</p>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?=  Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
        <div class="fee-index table-responsive">
                                                    <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
        'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                                'id',
            'name',
            'description:ntext',
            'price',
            'fee',
            // 'sale',
            // 'vat',
            // 'class_view',

                    ['class' => 'yii\grid\ActionColumn'],
                    ],
                    ]); ?>
                                
        </div>

    </div>
</div>
