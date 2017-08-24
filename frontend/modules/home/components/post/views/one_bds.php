<div class="col-sm-6" style="">
    <div class="box_tinmoi">
        <div class="row">
            <div class="col-xs-12">
                <h3><?= $model->getTitle('',70) ?></h3>
            </div>
            <div class="col-md-4 col-xs-4">
                <a class="img-feature" href="#">
                    <div style="background-image:url('<?= $model->getLinkAnh() ?>')"></div>
                </a>
            </div>
            <div class="col-md-8 col-xs-8">
                <div class="info">
                    <div class="divtext">
                        <div>
                            <label>Giá:</label><span> <?= $model->getGia() ?></span>
                        </div>
                        <div>
                            <label>Diện tích:</label> <?=  $model->getTextDienTich() ?>
                        </div>
                        <div>
                            <label>Vị trí:</label> <?= $model->getTextDiaDiem() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>