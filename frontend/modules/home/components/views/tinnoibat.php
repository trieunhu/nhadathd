<!-- Chuyen muc tin noi bat va xem nhieu -->
<section id="feature">

    <div class="row">
        <!-- Tin noi bat -->
        <div class="col-sm-8">
            <div class="box-feature box-style1">
                <?= \frontend\modules\home\components\OneCategoryWidgets::widget(['className'=>'equalheight2','category'=>$categoryNoiBat]) ?>
            </div>
        </div><!-- /Tin noi bat -->

       <?= \frontend\modules\home\components\TinXemNhieuWidgets::widget() ?>
    </div>
</section><!-- /Chuyen muc tin noi bat va xem nhieu -->