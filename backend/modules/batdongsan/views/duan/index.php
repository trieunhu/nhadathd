<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\batdongsan\models\DuanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tất cả dự án';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="duan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tạo mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [ 'class' => 'yii\grid\CheckboxColumn',],

            'id',
            'ten',
            'mo_ta:ntext',
            'dien_tich',
            'user_id',
            // 'chudautu_id',
            // 'diadiem_id',
            // 'ngay_tao',
            // 'slug',
            // 'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
            
            ],
        ],
    ]); ?>

</div>
