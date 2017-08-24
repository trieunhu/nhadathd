<?php
$i = 0;
$count = count($posts);
$row = ceil($count / 2);
?>
<!-- TIN RAO CÙNG KHU VỰC -->
<section class="box-style3" id="tin_rao_bds" style="margin: 20px 0px;">
    <div class="title">
        <h3><?= $title ?></h3>
    </div>
    <?php for($i = 0; $i < $row; $i++): ?>
        <div class="row">
            <?php
            for ($j= $i ; $j < $i + 2; $j++){
                $k = $i + $j;
                if ($k < $count){
                    $value = $posts[$k];
                    echo \frontend\modules\home\components\post\OneBdsWidgets::widget(['model' => $value]);
                }
            }
            ?>
        </div>
    <?php endfor; ?>
</section><!-- /TIN RAO CÙNG KHU VỰC -->
<div class="visitall">
    <a href="<?= $link ?>" title="Xem tất cả">Xem tất cả</a>
</div>