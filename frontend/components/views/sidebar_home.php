<!-- Noi dung chinh cot trai -->
<div class="col-sm-4" id="right-content">
    <?= \frontend\modules\home\components\AllDuanWidgets::widget() ?>

    <?= $banner->getValue() ?>

    <?= \frontend\modules\home\components\LienKetNoiBatWidgets::widget() ?>
    <?= \frontend\modules\home\components\TinhNangHoTroWidgets::widget() ?>
    <?= \frontend\modules\home\components\NguoiBanTieuBieuWidgets::widget() ?>

</div><!-- /Noi dung chinh cot phai -->