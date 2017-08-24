<!-- Dac diem -->
<div class="dacdiem">
    <div class="row">
        <div class="col-sm-6">
            <h3>Đặc điểm bất động sản</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td><b>Mã số</b></td>
                            <td style="color: #36a445; font-weight: bold">
                                <?= $model->ShowID(); ?></td>
                        </tr>
                        <tr>
                            <td><b>Loại tin rao</b></td>
                            <td><?= $titleCategory ?></td>
                        </tr>
                        <tr>
                            <td><b>Ngày đăng tin</b></td>
                            <td><?= $model->time ?></td>
                        </tr>
                        <tr>
                            <td><b>Ngày hết hạn</b></td>
                            <td><?= $model->expiration ?></td>
                        </tr>
                        <tr>
                            <td><b>Hướng nhà</b></td>
                            <td><?= $model->huong ? $model->huong->ten : ''; ?></td>
                        </tr>
                        <?php if($model->mat_tien): ?>
                            <tr>
                                <td><b>Ngày hết hạn</b></td>
                                <td><?= $model->mat_tien ?></td>
                            </tr>
                        <?php endif;?>
                        <?php if($model->duong_truoc_nha): ?>
                            <tr>
                                <td><b>Đường trước nhà</b></td>
                                <td><?= $model->duong_truoc_nha ?></td>
                            </tr>
                        <?php endif;?>
                        <?php if($model->so_tang): ?>
                            <tr>
                                <td><b>Số tầng</b></td>
                                <td><?= $model->so_tang ?></td>
                            </tr>
                        <?php endif;?>
                        <?php if($model->so_phong): ?>
                            <tr>
                                <td><b>Số phòng</b></td>
                                <td><?= $model->so_phong ?></td>
                            </tr>
                        <?php endif;?>
                        <?php if($model->so_tolet): ?>
                            <tr>
                                <td><b>Số tolet</b></td>
                                <td><?= $model->so_tolet ?></td>
                            </tr>
                        <?php endif;?>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-6">
            <h3>Thông tin liên hệ</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td><b>Tên liên lạc</b></td>
                            <td><?= $profile->display_name ?></td>
                        </tr>
                        <tr>
                            <td><b>Điện thoại</b></td>
                            <td><?= $profile->mobile ?></td>
                        </tr>
                        <tr>
                            <td><b>Email</b></td>
                            <td><?= $profile->email ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /Dac diem -->
<!-- Share -->
<div class="pd-share">
    <div class="row">
        <div class="col-xs-12">
            <a href="#" class="print"></a>
            <a id="saveNews" class="save"></a>
        </div>
    </div>
</div>
<!-- /Share -->