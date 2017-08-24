<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\batdongsan\models\ChudautuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chủ đầu tư';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chudautu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tạo mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ten',
            'mo_ta:ntext',
            'dien_thoai',
            'website',
            // 'email:email',
            // 'di',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
