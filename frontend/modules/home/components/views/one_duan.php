<?php if ($type == 'li'): ?>
    <li>
        <div class= "box-style3">
            <div class="row">								
                <div class="col-md-5">
                    <a class="img-feature"><div style="background-image:url('<?= $model->getLinkAnh() ?>')"></div></a>
                </div>
                <div class="col-md-7">
                    <div class="info">
                        <?= $model->getTitle('h4') ?>
                        <?= $model->getMota() ?>
                    </div>
                </div>
            </div>
        </div><!-- /Tin 1 -->
    </li>
<?php else: ?>
    <div class="item <?= $active ?>">
        <?= $model->getHinhAnh() ?>
        <div class="container">
            <div class="carousel-caption">
                <?= $model->getTitle('h4') ?>
                <?= $model->getMota() ?>
                <p><a class="btn btn-lg btn-primary" href="<?= $model->getLink() ?>" role="button">Xem ngay</a></p>
            </div>
        </div>
    </div>
<?php endif; ?>
