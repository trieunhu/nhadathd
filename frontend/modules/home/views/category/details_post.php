<?php
use common\models\Posts;
?>
<?= frontend\modules\home\components\ListTitleCategoryWidgets::widget(['parent' => $parent, 'model' => $category->menu]); ?>
<div class="noidung" style="margin:20px 0px;">
    <h3 class="entry-title"><?= $model->getTitle('none');?></h3>
    <div class="date-time"><?= $model->getTime() ?></div>
    <?php if($tag): ?>
    <div class="related-post">
        <p>Cùng chủ đề: <a href="<?= $tag->getLink() ?>"><strong><?= $tag->getTitle('none') ?></strong></a></p>
        <ul>
            <?php foreach ($postsTag as $value): ?>
            <li><?= $value->getTitle() ?></li>
            <?php endforeach;?>
        </ul>
    </div>
    <?php endif;?>
    <?php if(!empty($model->seo_description)): ?>
    <div class="entry-excerpt">
        <?= $model->seo_description ?>
    </div>
    <?php endif; ?>
    <div class="entry-content">
        <?= $model->getContent() ?>
    </div>
</div>
<?= frontend\modules\home\components\post\SameInfoWidgets::widget(['title'=>'Bài viết liên quan','category'=>$category,'type'=>  Posts::tableName(),'model'=>$model]) ?>
<!-- Các tin mới nhất -->
<?= \frontend\modules\home\components\post\CommentWidgets::widget() ?>