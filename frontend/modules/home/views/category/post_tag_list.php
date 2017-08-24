<?php
    use yii\widgets\LinkPager;
?>
<h1>Các bài viết thuộc chủ đề <?= $model->getTitle('none') ?></h1>
<section id="tin_rao_moi_nhat">
    <?php
        foreach ($posts as $value){
            echo frontend\modules\home\components\OnePostWidgets::widget(['model'=>$value]);
        }
    ?>
    <?php if ( $pagination->pageCount > 1): ?>
        <div class="page">
            <div class="row">
                <div class="col-xs-12">
                    <?=
                    LinkPager::widget(
                            [
                                'options' => [
                                    'class' => 'pull-right',
                                ],
                                'pagination' => $pagination,
                                'maxButtonCount' => 5,
                                'nextPageLabel' => 'Trang tiếp',
                                'prevPageLabel' => 'Trang trước',
                                'firstPageLabel' => 'Trang đầu',
                                'lastPageLabel' => 'Trang cuối',
                                'disabledPageCssClass' => 'hide',
                    ]);
                    ?>
                </div>
            </div>
        </div>
    <?php endif;?>
</section>