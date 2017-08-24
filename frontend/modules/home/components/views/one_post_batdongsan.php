<div class= "box-style3">
    <div class="row">
        <div class="col-sm-4">
            <a class="img-feature" href="<?= $model->getLink() ?>"><div style="background-image:url('<?= $model->getLinkAnh() ?>')"></div></a>
        </div>
        <div class="col-sm-8">
            <div class="info">
                <?= $model->getTitle('h4') ?>
                <table>
                    <tbody>
                        <tr>
                            <td><i class="fa fa-tags" aria-hidden="true"></i> Giá:</td>
                            <td style="color:#38A345; font-weight: bold"><?= $model->getGia(); ?></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-area-chart" aria-hidden="true"></i> Diện tích</td>
                            <td><?= $model->dien_tich ?> m²</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-map-marker" aria-hidden="true"></i> Vị trí:</td>
                            <td><?= $model->getTextDiaDiem() ?></td>
                        </tr>
                    </tbody>
                </table>
                <span class="date"><?= $model->getTime() ?></span>
            </div>
        </div>
    </div>
</div><!-- /Tin 1 -->