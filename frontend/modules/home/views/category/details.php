<?php
use common\models\Batdongsan;
list(, $url) = Yii::$app->assetManager->publish('@webroot/themes/bdshd');
$this->registerJsFile($url . '/js/lightslider.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile($url . '/css/lightslider.css');
?>
<div class="product-detail">
    <h1><?= $model->getTitle() ?></h1>
    <div class="pd-location">
        <i class="fa fa-map-marker" aria-hidden="true"></i>
        <span class="spanlocation">Khu vực:</span>
        <a style="color: #015f95;" href="<?= $model->getLinkDiaDiem() ?>"><?= $model->getTextDiaDiem() ?></a>

    </div>
    <div class="pd-price">
        Giá: <span class="spanprice"><?= $model->getGia() ?></span> Diện tích:<span><?=  $model->getTextDienTich() ?></span>
    </div>
    <div class="pd-desc">
        <h3>Thông tin mô tả</h3>
        <div class="pd-desc-content">
            <?= $model->getDescription() ?>
        </div>
    </div>
   <?= frontend\modules\home\components\post\MapSliderWidgets::widget(['model'=>$model]) ?>
    <?= frontend\modules\home\components\post\InfoWidgets::widget(['model'=>$model]) ?>
</div>
<?= frontend\modules\home\components\post\SameInfoWidgets::widget(['title'=>'TIN RAO CÙNG KHU VỰC','category'=>$category,'model'=>$model]) ?>
<?= ''//frontend\modules\home\components\post\SameInfoWidgets::widget(['title'=>'TIN RAO CÙNG GIÁ']) ?>
<!-- Các tin mới nhất -->
<?= \frontend\modules\home\components\post\CommentWidgets::widget() ?>
