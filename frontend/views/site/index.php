<?= \frontend\components\SearchHomeWidgets::widget() ?>
<content>
    <div class="container" id="noidung">
        <?= frontend\modules\home\components\TinNoiBatWidgets::widget() ?>

        <main id="main-content">
            <div class="row">

                <!-- Noi dung chinh cot trai -->
                <div class="col-sm-8">
                    <?= frontend\modules\home\components\TinRaoVatMoiNhatWidgets::widget() ?>
                    <?php
                        foreach ($categorys as $value) {
                            echo \frontend\modules\home\components\OneCategoryPostWidgets::widget(['category'=>$value]);
                        }
                        echo frontend\modules\home\components\TwoCategoryPostWidgets::widget(['categories'=>$categorys]);
                    ?>	
                </div><!-- /Noi dung chinh cot phai -->

                <?= \frontend\components\SideBarHomeWidgets::widget() ?>
            </div>
        </main>
    </div>
</content>
