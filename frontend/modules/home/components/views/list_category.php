<?php
//    var_dump($parent);
//    die();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="category">
            <ul>
                <?php if($parent): ?>
                <li class="<?= $parent->id == $model->id ? "active" : '' ?>"><?= $parent->category->getTitle() ?></li>
                <?php endif;?>
                <?php foreach ($parent->childs as $value): ?>
                    <li class="<?= $model->id == $value->id ? "active" : '' ?>"><?= $value->category->getTitle() ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>