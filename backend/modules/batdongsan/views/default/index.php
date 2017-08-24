<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\batdongsan\models\BatdongsanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bất động sản';
$this->params['breadcrumbs'][] = $this->title;
?>
<?=\backend\modules\posts\components\FilerIndexWidgets::widget([
    'title'=>$this->title,'dataList'=>$dataList,
    'filer'=>$filer,'type'=>$type,
    'linkAjax'=>$linkAjax,'arrTitle'=>$arrTitle]); ?>
<div class="batdongsan-index gridview">

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [ 'class' => 'yii\grid\CheckboxColumn',],
            [
                'attribute' => 'ten',
                'headerOptions' => ['style' => 'max-width: 50px'],
                'contentOptions' => ['style' => 'width: 300px;']
            ],
            'categoty' => [
                'attribute' => 'category_id',
                'label' => "Danh mục",
                'value' => function($data) {
                    return $data->getStringCategories();
                },
                'filter' => Html::activeDropDownList($searchModel, 'category_id', ArrayHelper::map(\backend\modules\posts\models\Category::find()->where(['type'=>'batdongsan'])->all(), 'id', 'title'), ['class' => 'form-control', 'prompt' => 'Tất cả']),
            ],
            'gia',
            'dien_tich',
            // 'mat_tien',
            // 'duong_truoc_nha',
            // 'user_id',
            // 'huong_id',
            // 'diadiem_id',
            // 'tinh_trang',
            // 'loai_id',
            // 'ngay_tao',
            // 'ngay_hien_thi',
            // 'ngay_het_han',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
            ],
        ],
    ]);
    ?>

</div>
