<div class="row">
    <?php foreach ($categories as $category): ?>
        <div class="col-sm-6" style="padding-right:7px">
            <div class="box-style4" id="tu_van_luat">
                <?= \frontend\modules\home\components\OneCategoryWidgets::widget(['className'=>'equalheight3','category' => $category, 'linkImage' => FALSE]) ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>