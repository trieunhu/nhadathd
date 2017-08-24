<div class="box-style3">
    <div class="row">								
        <div class="col-sm-4">
            <a class="img-feature"><div style="background-image:url('<?= $model->getLinkAnh() ?>')"></div></a>
        </div>
        <div class="col-sm-8">
            <div class="info">
                <?= $model->getTitle('h4')?>
                <?= $model->getMota() ?>
                <span><?= $model->getTime() ?></span>
            </div>
        </div>
    </div>
</div><!-- /Tin 1 -->