<?php

use yii\helpers\Html;

\frontend\assets\AppBdsHdAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html>
    <head>
        <?= $this->render('header') ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <?= frontend\modules\home\components\page\HeaderMenuWidgets::widget() ?>
    <content>
        <div class="container single" id="noidung">

            <main id="main-content">
                <div class="row">

                    <!-- Noi dung chinh cot trai -->
                    <div class="col-sm-8">
                        <?= $content ?>
                    </div><!-- /Noi dung chinh cot phai -->

                    <!-- Noi dung chinh cot trai -->
                    <div class="col-sm-4" id="right-content">
                        <!-- Hop tim kiem BDS -->
                        <?= \frontend\modules\home\components\SearchRightWidgets::widget() ?>
                        <?= \frontend\modules\home\components\NhanTinBdsWidgets::widget() ?>
                        <?= \frontend\modules\home\components\LienKetNoiBatWidgets::widget() ?>
                        <?php  //\frontend\modules\home\components\TinhNangHoTroWidgets::widget() ?>
                        <?php //\frontend\modules\home\components\NguoiBanTieuBieuWidgets::widget() ?>

                    </div><!-- /Noi dung chinh cot phai -->
                </div>
            </main>
        </div>
    </content>
    <?= \frontend\modules\home\components\page\FooterWidgets::widget() ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>