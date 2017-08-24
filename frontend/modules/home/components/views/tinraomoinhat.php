<?php

use yii\widgets\LinkPager;
use frontend\components\LinkSpanPager;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<section id="tin_rao_moi_nhat">
    <div class="title">
        <h3><?= $title ?></h3>
        <div class="tab" id="tabList">		
            <?php if ($select_order == 'select'): ?>
                <?php $form = ActiveForm::begin(['id' => 'seclect-order-form', 'enableClientScript' => false,]); ?>
                <div class="select-order">
                    <div class="option-item">
                        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                        <span class="v-drop v-drop-width" id="spanCate">Sắp xếp theo: </span>
                        <?= Html::activeDropDownList($select, "select_id", $select->getValueLabel(), ["id" => "ddlOrder"]) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            <?php endif; ?>
        </div>
    </div>

    <?php
    foreach ($models as $value) {
        echo frontend\modules\home\components\OnePostBdsWidgets::widget(['model' => $value]);
    }
    ?>
    <?php if ($select_order == 'select' && $pagination->pageCount > 1): ?>
        <div class="page">
            <div class="row">
                <div class="col-xs-12">
                    <?=
                    LinkPager::widget(
                            [
                                'options' => [
                                    'class' => 'pull-right',
                                ],
                                'pagination' => $pagination,
                                'maxButtonCount' => 5,
                                'nextPageLabel' => 'Trang tiếp',
                                'prevPageLabel' => 'Trang trước',
                                'firstPageLabel' => 'Trang đầu',
                                'lastPageLabel' => 'Trang cuối',
                                'disabledPageCssClass' => 'hide',
                    ]);
                    ?>
                </div>
            </div>
        </div>
    <?php elseif ($select_order != 'select'): ?>
        <div class="page">
            <div class="row">
                <?php if ($pagination->pageCount > 1): ?>
                    <div class="col-md-6">
                        Tin Nhà đất bán mới nhất:
                        <?=
                        LinkSpanPager::widget(
                                [
                                    'options' => [
                                    ],
                                    'pagination' => $pagination,
                                    'maxButtonCount' => 5,
                                    'firstPageCssClass' => 'hide',
                                    'lastPageCssClass' => 'hide',
                                    'action' => 'home/category/post',
                                    'slug' => $categoryBan != NULL ? $categoryBan->slug : "",
                        ]);
                        ?>
                    </div>
                <?php endif; ?>
                <?php if ($paginationThue->pageCount > 1): ?>
                    <div class="col-md-6 pull-right text-right">
                        Tin Nhà đất cho thuê mới nhất:
                        <?=
                        LinkSpanPager::widget(
                                [
                                    'options' => [
                                    ],
                                    'pagination' => $paginationThue,
                                    'maxButtonCount' => 5,
                                    'firstPageCssClass' => 'hide',
                                    'lastPageCssClass' => 'hide',
                                    'action' => 'home/category/post',
                                    'slug' => $categoryBan != NULL ? $categoryThue->slug : "",
                        ]);
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div><!-- /phan trang cho tin rao moi nhat -->
    <?php endif; ?>
</section><!-- /Tin rao moi nhat -->
<script>
    window.onload = function () {
        $('#ddlOrder').change(function () {
            console.log("kslsk");
            $('#seclect-order-form').submit();
        });
    }
</script>