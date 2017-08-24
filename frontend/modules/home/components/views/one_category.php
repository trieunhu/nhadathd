<?php 
    $divClass = 'col-sm-7';
    $divClass1 = 'col-sm-5';
    if ($className == 'equalheight2') {
        $divClass = 'col-sm-6';
        $divClass1 = 'col-sm-6';
    }elseif ($className == 'equalheight3') {
        $divClass = 'col-xs-12';
        $divClass1 = 'col-xs-12';
    }elseif ($className == 'col-sm-6') {
        $divClass ='col-sm-6';
        $divClass1 = 'col-sm-6';
    }
?>
<div class="title"><h3><?= $category->title ?></h3></div>
<div class="row">
    <div class="<?= $divClass ?>">
        <div class="box-feature-left <?= $className ?>">
            <?php
            if (count($posts) > 0) {
//                if ($linkImage) {
//                    echo $posts[0]->getHinhAnh();
//                }  else {
//
//                }
                echo $posts[0]->getHinhAnhLink();
                echo $posts[0]->getTitle();
            }
            ?>
        </div>
    </div>
    <div class="<?= $divClass1 ?>" style=" <?= $className == 'col-sm-6' ? 'padding-left:0px;' : '' ?>">
        <div class="box-feature-right <?= $className ?>">
            <?php if (count($posts) > 1): ?>
                <ul class="danhsach_tin">
                    <?php for ($i = 1; $i < count($posts); $i++): ?>
                        <li><?= $posts[$i]->getTitle(); ?></li>
                    <?php endfor; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>