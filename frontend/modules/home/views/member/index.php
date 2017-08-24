<?php
list(, $url) = Yii::$app->assetManager->publish(Yii::getAlias("@webroot") . '/themes/bdshd/js');
$this->registerJsFile($url . '/jquery.nice-select.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($url . '/moment-with-locales.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($url . '/bootstrap-datetimepicker.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($url . '/customInput.jquery.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias("@web") . '/themes/bdshd/js' . '/call_js.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
list(, $url) = Yii::$app->assetManager->publish(Yii::getAlias("@webroot") . '/themes/bdshd/css');
$this->registerCssFile($url . '/nice-select.css');
$this->registerCssFile($url . '/bootstrap-datetimepicker.css');
?>
<?= \frontend\modules\home\components\member\LeftMemberWidgets::widget() ?>
<div class="col-md-7">
    <div class="postnews">
        <div id="ContentPlaceHolder1_PostNews_pnDangtin">
            <div class="pn-title">
                <h1>QUẢN LÝ TIN RAO BÁN / CHO THUÊ</h1>
            </div>
            <div class="pn-content">
                <div class="module-search">
                    <div>
                        <div class="row-right">
                            <div class="pncon">
                                <select>
                                    <option value="-1" class="selected">Loại tin</option>
                                    <option value="0">Tin Siêu Vip</option>
                                    <option value="1">Tin Vip</option>
                                    <option value="2">Tin Hot</option>
                                    <option value="3">Tin thường</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="advance-control">
                        <input name="txtTungay" type="text" id="txtTungay" tabindex="21" class="form-control datetimepicker1" style="width: 110px;">
                    </div>
                    <div class="advance-control">
                        <input name="txtTungay" type="text" id="txtDenngay" tabindex="21" class="form-control datetimepicker1" style="width: 110px;">
                    </div>
                    <div>
                        <div class="row-right">
                            <div class="pncon">
                                <select>
                                    <option value="-1" class="selected">Loại giao dịch</option>
                                    <option value="0">Hiển thị</option>
                                    <option value="1">Tin hết hạn</option>
                                    <option value="2">Tin bị hạ</option>
                                    <option value="3">Tin bị xóa</option>
                                    <option value="3">Tin chưa duyệt</option>
                                    <option value="3">Tin chưa thanh toán</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="module-search">
                    <div style="width: 100%; margin: 10px 0;">
                        <span>Mã tin (Lưu ý khi nhập mã tin thì các bộ lọc khác không có tác dụng)</span>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <input name="txtmatin" type="text" id="txtmatin" class="form-control" placeholder="Mã tin">
                        </div>
                        <div class="col-sm-6">
                            <button class="btn btn-success">Tìm kiếm</button>
                        </div>
                    </div>
                </div>
                <table class="table member-table-data table-responsive table-hover">
                    <thead>
                    <tr>
                        <td>Mã tin</td>
                        <td>Tiêu đề</td>
                        <td>Trạng thái</td>
                        <td>Ngày đăng</td>
                        <td>Hết hạn</td>
                        <td>Thao tác</td>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= \frontend\modules\home\components\member\NoticeMemberWidgets::widget() ?>