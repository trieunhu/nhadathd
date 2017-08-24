<div class="row">
    <div class="col-xs-12">
        <div class="title-page text-left"><h1><?= $model->seo_title ?></h1></div>
    </div>
    <div class="col-xs-12">
        <div class="result text-right">Có <b><?= $count ?></b> bất động sản</div>
    </div>
</div><!-- /Tieu de trang -->
<?= frontend\modules\home\components\TinRaoVatMoiNhatWidgets::widget(['select_order' => 'select', 'title' => 'DANH SÁCH TIN RAO', 'models' => $models, 'pagination' => $pagination, 'select' => $select]) ?>