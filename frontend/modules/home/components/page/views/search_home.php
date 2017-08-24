<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use frontend\modules\home\models\SearchForm;
list(, $url) = Yii::$app->assetManager->publish(Yii::getAlias("@webroot") . '/themes/bdshd/js');
$this->registerJsFile($url . '/jquery.nice-select.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($url . '/moment-with-locales.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($url . '/bootstrap-datetimepicker.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($url . '/customInput.jquery.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias("@web") . '/themes/bdshd/js' . '/call_js.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
list(, $url) = Yii::$app->assetManager->publish(Yii::getAlias("@webroot") . '/themes/bdshd/css');
$this->registerCssFile($url . '/nice-select.css');
$this->registerCssFile($url . '/bootstrap-datetimepicker.css');
?>
<section class="main_search">
    <div class="container">
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#bds_ban" aria-controls="bds_ban" role="tab" data-toggle="tab">Bất động sản bản</a>
                </li>
                <li role="presentation">
                    <a href="#bds_t" aria-controls="bds_t" role="tab" data-toggle="tab">Bất động sản cho thuê</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="bds_ban">
                    <?php $form = ActiveForm::begin(['action' => '/home/category/search']); ?>
                    <input type="hidden" name="search"/>
                    <div class="row">
                        <div class="col-xs-12">
                            <?= Html::activeTextInput($model, 'title', ['placeholder' => $model->getAttributeLabel('title'), 'id' => 'tags']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <ul>
                                <li class="inline">
                                    <?php
                                    $model->category_parent = \common\models\Category::BATDONGSAN_BAN;
                                    echo $form->field($model,'category_parent')->hiddenInput()->label(false);
                                    $maps = SearchForm::getCategories($model->category_parent);
                                    echo Html::activeDropDownList($model,'category_id',$maps[0],['class'=>'selectpicker','prompt'=>$model->getAttributeLabel('category_id'),'options'=>$maps[1]]) ?>
                                </li>
                                <li class="inline">
                                    <?= Html::activeDropDownList($model, 'tinh_id', SearchForm::getListTinh(), ['class' => 'selectpicker thanhpho_id','data-live-search'=>"true", 'prompt' => $model->getAttributeLabel('tinh_id')]) ?>
                                </li>
                                <li class="inline">
                                    <?= Html::activeDropDownList($model, 'huyen_id', [], ['class' => 'selectpicker huyen_id', 'prompt' => $model->getAttributeLabel('huyen_id')]) ?>
                                </li>
                                <li class="inline">
                                    <?= Html::activeDropDownList($model, 'xa_id', [], ['class' => 'selectpicker xa_id', 'prompt' => $model->getAttributeLabel('xa_id')]) ?>
                                </li>
                                <li class="inline">
                                    <?= Html::activeDropDownList($model, 'gia_id', SearchForm::getListGia(), ['class' => 'selectpicker', 'prompt' => $model->getAttributeLabel('gia_id')]) ?>
                                </li>
                                <li class="inline">
                                    <?= Html::activeDropDownList($model, 'dien_tich', SearchForm::getListDienTich(), ['class' => 'selectpicker', 'prompt' => $model->getAttributeLabel('dien_tich')]) ?>
                                </li>
                                <li class="inline">
                                    <?= Html::activeDropDownList($model, 'huong_id', SearchForm::getListHuong(), ['class' => 'selectpicker', 'prompt' => $model->getAttributeLabel('huong_id')]) ?>
                                </li>
                                <li class="inline"><input type="submit" name="timkiem" value="Tìm kiếm"></li>
                            </ul>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="bds_t">
                    <?php $form = ActiveForm::begin(['action' => '/home/category/search']); ?>
                    <input type="hidden" name="search"/>
                    <div class="row">
                        <div class="col-xs-12">
                            <?= Html::activeTextInput($model, 'title', ['placeholder' => $model->getAttributeLabel('title'), 'id' => 'tags']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <ul>
                                <li class="inline">
                                    <?php
                                    $model->category_parent = \common\models\Category::BATDONGSAN_THUE;
                                    echo $form->field($model,'category_parent')->hiddenInput()->label(false);
                                    $maps = SearchForm::getCategories($model->category_parent);
                                    echo Html::activeDropDownList($model,'category_id',$maps[0],['class'=>'selectpicker','prompt'=>$model->getAttributeLabel('category_id'),'options'=>$maps[1]]) ?>
                                </li>
                                <li class="inline">
                                    <?= Html::activeDropDownList($model, 'tinh_id', SearchForm::getListTinh(), ['class' => 'selectpicker thanhpho_id','data-live-search'=>"true", 'prompt' => $model->getAttributeLabel('tinh_id')]) ?>
                                </li>
                                <li class="inline">
                                    <?= Html::activeDropDownList($model, 'huyen_id', [], ['class' => 'selectpicker huyen_id', 'prompt' => $model->getAttributeLabel('huyen_id')]) ?>
                                </li>
                                <li class="inline">
                                    <?= Html::activeDropDownList($model, 'xa_id', [], ['class' => 'selectpicker xa_id', 'prompt' => $model->getAttributeLabel('xa_id')]) ?>
                                </li>
                                <li class="inline">
                                    <?= Html::activeDropDownList($model, 'gia_id', SearchForm::getListGia(), ['class' => 'selectpicker', 'prompt' => $model->getAttributeLabel('gia_id')]) ?>
                                </li>
                                <li class="inline">
                                    <?= Html::activeDropDownList($model, 'dien_tich', SearchForm::getListDienTich(), ['class' => 'selectpicker', 'prompt' => $model->getAttributeLabel('dien_tich')]) ?>
                                </li>
                                <li class="inline">
                                    <?= Html::activeDropDownList($model, 'huong_id', SearchForm::getListHuong(), ['class' => 'selectpicker', 'prompt' => $model->getAttributeLabel('huong_id')]) ?>
                                </li>
                                <li class="inline"><input type="submit" name="timkiem" value="Tìm kiếm"></li>
                            </ul>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div><!-- /tab -->
    </div><!-- /container -->
</section><!-- /Hop tim kiem chinh tren trang chu -->