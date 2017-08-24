
<content>
    <div class="container" id="noidung">
        <!-- Chuyen muc tin noi bat va xem nhieu -->
        <section id="feature">

            <div class="row">
                <div class="col-sm-4 col-sm-push-8">
                    <?= \frontend\modules\home\components\SearchRightWidgets::widget() ?>
                </div><!-- /Hop tim kiem BDS -->

                <!-- Tin noi bat -->
                <div class="col-sm-8 col-sm-pull-4">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="category">
                                <ul>
                                    <li class="<?= $parent->id == $model->id ? "active" : '' ?>"><?= $parent->getTitle() ?></li>
                                    <?php foreach ($categorys as $value): ?>
                                        <li class="<?= $model->id == $value->id ? "active" : '' ?>"><?= $value->getTitle() ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?= frontend\modules\home\components\OneCategoryPostWidgets::widget(['category' => $model]) ?>


                </div>
            </div>
        </section><!-- /Chuyen muc tin noi bat va xem nhieu -->

        <main id="main-content">
            <div class="row">

                <!-- Noi dung chinh cot trai -->
                <div class="col-sm-8">
                    <?php
                    if (count($categorys) > 0) {
                        $values = [];
                        for ($index = 0; $index < count($categorys); $index++) {
                            if ($index < 2) {
                                echo \frontend\modules\home\components\OneCategoryPostWidgets::widget(['category' => $categorys[$index]]);
                            } elseif ($index < 4) {
                                if (count($values) < 2) {
                                    array_push($values, $categorys[$index]);
                                }
                            }
                        }
                        echo frontend\modules\home\components\TwoCategoryPostWidgets::widget(['categories' => $values]);
                    }
                    ?>	
                </div><!-- /Noi dung chinh cot phai -->

                <!-- Noi dung chinh cot trai -->
                <div class="col-sm-4" id="right-content">
                    <section id="tinxemnhieu">
                        <?= \frontend\modules\home\components\TinXemNhieuWidgets::widget(['div_ngoai' => 'nodiv']) ?>
                    </section>
                    <?= \frontend\modules\home\components\LienKetNoiBatWidgets::widget() ?>

                    <?= \frontend\modules\home\components\NguoiBanTieuBieuWidgets::widget() ?>

                </div><!-- /Noi dung chinh cot phai -->
            </div>
        </main>
    </div>
</content>