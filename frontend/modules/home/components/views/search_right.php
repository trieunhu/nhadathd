<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use frontend\modules\home\models\SearchForm;
use common\models\Category;
list(, $url) = Yii::$app->assetManager->publish(Yii::getAlias("@webroot") . '/themes/bdshd/js');
$this->registerJsFile($url . '/jquery.nice-select.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($url . '/moment-with-locales.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($url . '/bootstrap-datetimepicker.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($url . '/customInput.jquery.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias("@web") . '/themes/bdshd/js' . '/call_js.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
list(, $url) = Yii::$app->assetManager->publish(Yii::getAlias("@webroot") . '/themes/bdshd/css');
$this->registerCssFile($url . '/nice-select.css');
$this->registerCssFile($url . '/bootstrap-datetimepicker.css');
$provinces = SearchForm::getListTinh();
$districts = $model->getListDistrict();
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- Hop tim kiem BDS -->
<section id="search_right" style="">
    <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="<?= $activeBan ?>">
                <a href="#bdsban" aria-controls="bdsban" role="tab" data-toggle="tab">BĐS Bán</a>
            </li>
            <li role="presentation" class="<?= $activeThue ?>">
                <a href="#bdsthue" aria-controls="bdsthue" role="tab" data-toggle="tab">BĐS thuê</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content search_right">
            <div role="tabpanel" class="tab-pane <?= $activeBan ?>" id="bdsban">
                <?php $form = ActiveForm::begin(['action'=>'/home/category/search','options'=>['id'=>'ban_bds']]); ?>
                <input type="hidden" name="search"/>
                <?= Html::activeTextInput($model,'title',['placeholder'=>$model->getAttributeLabel('title'),'id'=>'tags']) ?>
                <?php
                $model->category_parent = \common\models\Category::BATDONGSAN_BAN;
                echo $form->field($model,'category_parent')->hiddenInput()->label(false);
                $maps = SearchForm::getCategories($model->category_parent);
                echo Html::activeDropDownList($model,'category_id',$maps[0],['class'=>'selectpicker col-md-12 margin-bottom-10','prompt'=>$model->getAttributeLabel('category_id'),'options'=>$maps[1]]); ?>
                <?= Html::activeDropDownList($model,'tinh_id',$provinces,['class'=>'selectpicker col-md-12 margin-bottom-10 thanhpho_id','data-live-search'=>"true",'prompt'=>$model->getAttributeLabel('tinh_id')]) ?>
                <?= Html::activeDropDownList($model,'huyen_id',$districts,['class'=>'selectpicker col-md-12 margin-bottom-10 huyen_id','prompt'=>$model->getAttributeLabel('huyen_id')]) ?>
                <?= Html::activeDropDownList($model,'dien_tich',SearchForm::getListDienTich(),['class'=>'selectpicker col-md-12 margin-bottom-10','prompt'=>$model->getAttributeLabel('dien_tich')]) ?>
                <?= Html::activeDropDownList($model,'gia_id',SearchForm::getListGia(),['class'=>'selectpicker col-md-12 margin-bottom-10','prompt'=>$model->getAttributeLabel('gia_id')]) ?>
                <?= Html::activeDropDownList($model,'huong_id',SearchForm::getListHuong(),['class'=>'selectpicker col-md-12 margin-bottom-10','prompt'=>$model->getAttributeLabel('huong_id')]) ?>
                <div class="row">
                    <div class="col-xs-5 pull-right" style="padding-left: 0px">
                        <a href="javascript:{}" onclick="document.getElementById('ban_bds').submit();" class="greenbtn timkiem_btn pull-right">Tìm kiếm</a>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div role="tabpanel" class="tab-pane <?= $activeThue ?>" id="bdsthue">
                <?php $form = ActiveForm::begin(['action'=>'/home/category/search','options'=>['id'=>'ban_thue']]); ?>
                <input type="hidden" name="search"/>
                <?= Html::activeTextInput($model,'title',['placeholder'=>$model->getAttributeLabel('title'),'id'=>'tags']) ?>
                <?php
                $model->category_parent = \common\models\Category::BATDONGSAN_THUE;
                echo $form->field($model,'category_parent')->hiddenInput()->label(false);
                $maps = SearchForm::getCategories($model->category_parent);
                echo Html::activeDropDownList($model,'category_id',$maps[0],['class'=>'selectpicker col-md-12 margin-bottom-10','prompt'=>$model->getAttributeLabel('category_id'),'options'=>$maps[1]]) ?>

                <?= Html::activeDropDownList($model,'tinh_id',$provinces,['class'=>'selectpicker col-md-12 margin-bottom-10 thanhpho_id','data-live-search'=>"true",'prompt'=>$model->getAttributeLabel('tinh_id')]) ?>
                <?= Html::activeDropDownList($model,'huyen_id',$districts,['class'=>'selectpicker col-md-12 margin-bottom-10 huyen_id','prompt'=>$model->getAttributeLabel('huyen_id')]) ?>
                <?= Html::activeDropDownList($model,'dien_tich',SearchForm::getListDienTich(),['class'=>'selectpicker col-md-12 margin-bottom-10','prompt'=>$model->getAttributeLabel('dien_tich')]) ?>
                <?= Html::activeDropDownList($model,'gia_id',SearchForm::getListGia(),['class'=>'selectpicker col-md-12 margin-bottom-10','prompt'=>$model->getAttributeLabel('gia_id')]) ?>
                <?= Html::activeDropDownList($model,'huong_id',SearchForm::getListHuong(),['class'=>'selectpicker col-md-12 margin-bottom-10','prompt'=>$model->getAttributeLabel('huong_id')]) ?>
                <div class="row">
                    <div class="col-xs-5 pull-right" style="padding-left: 0px">
                        <a href="javascript:{}" onclick="document.getElementById('ban_thue').submit();" class="greenbtn timkiem_btn pull-right">Tìm kiếm</a>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>