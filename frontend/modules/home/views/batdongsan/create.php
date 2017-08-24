<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_dJ65r0h4TBIF8IVjsuHzd0_pSOP9qyY"
        type="text/javascript"></script>
<?php


use yii\widgets\ActiveForm;
use frontend\modules\home\models\SearchForm;
use yii\helpers\Html;

list(, $url) = Yii::$app->assetManager->publish(Yii::getAlias("@webroot") . '/themes/bdshd/js');
$this->registerJsFile($url . '/jquery.nice-select.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($url . '/moment-with-locales.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($url . '/bootstrap-datetimepicker.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($url . '/customInput.jquery.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias("@web") . '/themes/bdshd/js' . '/map.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias("@web") . '/themes/bdshd/js' . '/formbds.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
list(, $url) = Yii::$app->assetManager->publish(Yii::getAlias("@webroot") . '/themes/bdshd/css');
$this->registerCssFile($url . '/nice-select.css');
$this->registerCssFile($url . '/bootstrap-datetimepicker.css');
$districts = $model->getListDistrict();
?>
<?= \frontend\modules\home\components\member\LeftInfoWidgets::widget() ?>
<div class="col-md-9">
    <div class="postnews">
        <div id="ContentPlaceHolder1_PostNews_pnDangtin">
            <div class="pn-title">
                <h1>Đăng tin rao bán, cho thuê nhà đất</h1>
            </div>
            <?php $form = ActiveForm::begin(); ?>
            <div class="pn-content">

                <h4 class="posth4">THÔNG TIN CƠ BẢN</h4>
                <div class="row">
                    <div class="col-sm-3">
                        <label style="float: none; display: inline-block;">Loại tin <span>(*)</span>:</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="custom-radio">
                            <input type="radio" name="bds" id="bds-1" value="14" class="radioinput categoryradio" checked="checked">
                            <label for="bds-1" class="checked">BĐS Bán</label>
                        </div>

                        <div class="custom-radio">
                            <input type="radio" name="bds" id="bds-2" value="15" class="radioinput categoryradio">
                            <label for="bds-2">BĐS Cho Thuê</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Loại nhà đất <span>(*)</span>:</label>
                    </div>
                    <div class="col-sm-9">
                        <?php $maps = SearchForm::getCategories(\common\models\Category::BATDONGSAN_BAN);
                        echo Html::activeDropDownList($model,'category_id',$maps[0],['class'=>'selectpicker category_id','prompt'=>$model->getAttributeLabel('category_id'),'options'=>$maps[1]]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Vị trí <span>(*)</span></label>
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <?= $form->field($model,'tinh_id',['options'=>['class'=>'col-sm-6'],'errorOptions'=>['class'=>'col-sm-12 no-padding no-margin help-block']])->dropDownList(SearchForm::getListTinh(),['class' => 'selectpicker thanhpho_id', 'prompt' => $model->getAttributeLabel('tinh_id')])->label(false) ?>
                            <?= $form->field($model,'huyen_id',['options'=>['class'=>'col-sm-6','errorOptions'=>['class'=>'col-sm-12 no-padding no-margin help-block']]])->dropDownList([],['class' => 'selectpicker huyen_id', 'prompt' => $model->getAttributeLabel('huyen_id')])->label(false) ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="select-container" id="cboWardP">
                                    <?= Html::activeDropDownList($model, 'xa_id', [], ['class' => 'selectpicker xa_id', 'prompt' => $model->getAttributeLabel('xa_id')]) ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <select id="ddlProjects" style="display: none;">
                                    <option value="-1">-- Chọn Dự án --</option>
                                </select>
                                <div class="nice-select" tabindex="0"><span class="current">-- Chọn Dự án --</span>
                                    <ul class="list">
                                        <li data-value="-1" class="option selected">-- Chọn Dự án --</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'gia',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-6">{label}</div><div class="col-sm-6">{input}</div>'])->textInput(['maxlength' => true,'id'=>'input_price']) ?>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-3"><label>Đơn vị:</label></div>
                            <div class="col-sm-9">
                                <?= Html::activeDropDownList($model, 'gia_id', \frontend\modules\home\models\BatdongsanForm::getListDonVi(), ['class' => 'selectpicker', 'prompt' => $model->getAttributeLabel('gia_id')]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?= $form->field($model, 'dien_tich',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-3">{label}</div><div class="col-sm-9">{input}</div><div class="col-sm-12 col-md-9 col-md-offset-3">{error}</div>'])->textInput(['maxlength' => true,'id'=>'input_area']) ?>
                <?= $form->field($model, 'dia_diem',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-3">{label}</div><div class="col-sm-9">{input}</div><div class="col-sm-12 col-md-9 col-md-offset-3">{error}</div>'])->textInput(['maxlength' => true,'id'=>'diadiem_id']) ?>
                <h4 class="posth4">THÔNG TIN KHÁC</h4>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'mat_tien',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-6">{label}</div><div class="col-sm-6">{input}</div>'])->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'duong_truoc_nha',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-5">{label}</div><div class="col-sm-7">{input}</div>'])->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'so_tang',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-6">{label}</div><div class="col-sm-6">{input}</div>'])->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'so_phong',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-5">{label}</div><div class="col-sm-7">{input}</div>'])->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6"><label>Hướng BĐS:</label></div>
                            <div class="col-sm-6">
                                <?= Html::activeDropDownList($model, 'huong_id', SearchForm::getListHuong(), ['class' => 'selectpicker', 'prompt' => $model->getAttributeLabel('huong_id')]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'so_tolet',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-5">{label}</div><div class="col-sm-7">{input}</div>'])->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <h4 class="posth4">MÔ TẢ CHI TIẾT</h4>
                <?= $form->field($model, 'ten',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-3">{label}</div><div class="col-sm-9">{input}<span class="txtProductTitle_count" style="margin-left: 10px; line-height: 28px"><span id="leng_input_title">0</span>/99</span></div><div class="col-sm-12 col-md-9 col-md-offset-3 clearfix">{error}</div>'])->textInput(['maxlength' => true,'class'=>'form-control form-controlx2','id'=>'input_title']) ?>
                <?= $form->field($model, 'mo_ta',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-3">{label}</div><div class="col-sm-9">{input}</div><div class="col-sm-12 col-md-9 col-md-offset-3 clearfix">{error}</div>'])->textarea(['maxlength' => true,'class'=>'form-control','rows'=>5,'style'=>'margin-bottom: 10px;']) ?>
                <div class="row wr_upload">
                    <div class="col-sm-3">
                        <label>Cập nhật hình ảnh:</label>
                    </div>
                    <div class="col-sm-9">
                        <span id="spanLuuY" style="display:block; ">(Bạn có thể tải 16 ảnh và mỗi ảnh dung lượng không quá 4mb!)</span>
                        <div id="listImage">

                        </div>
                        <div class="upload-item working-upload-item" id="working-upload-item"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><p">Cập nhật Video:<p></p></p"></div>
                    <div class="col-sm-9">
                        <span>Nếu bạn có nhu cầu Upload video, hãy liên hệ với chúng tôi để được hỗ trợ</span>
                    </div>
                </div>
                <h4 class="posth4">THÔNG TIN BẢN ĐỒ</h4>
                <div class="row">
                    <div class="col-xs-12">
                        <div id="map-canvas" style="position: relative; overflow: hidden;">
                        </div>
                    </div>
                </div>
                <h4 class="posth4">THÔNG TIN LIÊN HỆ</h4>
                <?= $form->field($model, 'display_name',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-3">{label}</div><div class="col-sm-9">{input}</div><div class="col-sm-12 col-md-9 col-md-offset-3">{error}</div>'])->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'address',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-3">{label}</div><div class="col-sm-9">{input}</div><div class="col-sm-12 col-md-9 col-md-offset-3">{error}</div>'])->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'mobile',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-3">{label}</div><div class="col-sm-9">{input}</div><div class="col-sm-12 col-md-9 col-md-offset-3">{error}</div>'])->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'email',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-3">{label}</div><div class="col-sm-9">{input}</div><div class="col-sm-12 col-md-9 col-md-offset-3">{error}</div>'])->textInput(['maxlength' => true]) ?>
                <div class="row1"></div>
                <h4 class="posth4">LOẠI TIN VÀ LỊCH ĐĂNG TIN:</h4>
                <p>Để đáp ứng tốt nhu cầu của Khách hàng, <a target="_blank" href="/" class="text-blue"><strong>nhadathd.vn</strong></a>
                    cho ra đời dịch vụ đăng tin Hot, tin Vip và tin siêu Vip với nhiều ưu đãi về hình thức và vị trí
                    hiển thị. Click <a href="#" target="_blank" class="text-blue"><strong>vào đây</strong></a> để xem
                    thông tin chi tiết.</p>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Loại tin rao <span>(*)</span>:</label>
                    </div>
                    <div class="col-sm-9">
                        <?php $dataFees = []; ?>
                        <?php foreach ($fees as $fee): ?>
                            <?php
                            $dataFees[$fee->id]['price_day'] = $fee->price;
                            $dataFees[$fee->id]['fee_day'] = $fee->fee;
                            $dataFees[$fee->id]['fee_vat'] = $fee->vat;
                            $dataFees[$fee->id]['khuyen_mai'] = $fee->sale;
                            $dataFees[$fee->id]['total_money'] = $fee->price;
                            ?>
                            <div class="custom-radio">
                                <input type="radio" name="fee" value="<?= $fee->id ?>" data-class="<?= $fee->class_view ?>" id="data<?= $fee->id ?>" class="radioinput2 feeradio">
                                <label for="data<?= $fee->id ?>" data-toggle="tooltip"  data-placement="top" title="" data-original-title="<?= strip_tags($fee->description) ?>">
                                    <?= $fee->name ?>
                                </label>
                            </div>
                            <br>
                        <?php endforeach; ?>
                        <?php $json = json_encode($dataFees); ?>
                        <input type="hidden" id="datafee" value='<?= $json ?>'>
                        <?= $form->field($model, 'fee_id',['options'=>['class'=>'row'],'template'=>'{input}<div class="col-sm-12">{error}</div>'])->hiddenInput(['id'=>'feeid']) ?>
                        <?= $form->field($model, 'positionX',['options'=>['class'=>'row'],'template'=>'{input}'])->hiddenInput(['id'=>'txtPositionX']) ?>
                        <?= $form->field($model, 'positionY',['options'=>['class'=>'row'],'template'=>'{input}'])->hiddenInput(['id'=>'txtPositionY']) ?>
                        <div class="preview">
                            <div class="row fee">
                                <div class="col-sm-12">
                                    <div class="col-sm-2 no-padding">
                                        <label id="viptype-title"><b></b></label>
                                    </div>
                                    <?php foreach ($fees as $fee): ?>
                                    <div class="col-sm-10 no-padding vip-desc" id="vip-desc<?php echo $fee->id; ?>" style=" display: none;">
                                        <?php echo $fee->description; ?>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="box-style3">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <a class="img-feature"><div style="background-image:url('images/tinrao1.jpg')"></div></a>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="info">
                                            <a href="#"><h4 class="" id="priview-title"></h4></a>
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td><i class="fa fa-tags" aria-hidden="true"></i> Giá:</td>
                                                    <td style="color:#38A345; font-weight: bold" id="preview_price">N/A Triệu/m²</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-area-chart" aria-hidden="true"></i> Diện tích</td>
                                                    <td ><span id="preview_area">N/A</span> m²</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-map-marker" aria-hidden="true"></i> Vị trí:</td>
                                                    <td id="preview_address"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <span class="date"><?= date('d/m/Y') ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <label>Thời gian đăng <span>(*)</span>:</label>
                    </div>

                    <div class="col-sm-9">
                        <div class="col-sm-6 col-xs-12">
                            <span class="span"
                                  style="margin-top: 10px;float: left;margin-left: -15px;margin-right: 15px;">Từ</span>
                            <?= Html::activeInput('input',$model,'ngay_hien_thi',['class'=>'form-control datetimepicker1','style'=>'width: 130px;','id'=>'txtTungay']) ?>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <span class="span"
                                  style="margin-top: 10px;float: left;margin-left: -15px;margin-right: 15px;">Đến</span>
                            <?=  Html::activeInput('input',$model,'ngay_het_han',['class'=>'form-control','style'=>'width: 130px;float:left;','id'=>'txtDenngay']) ?>
                            <span style="margin-top: 10px;float: left;margin-right: 15px;" id="subdate">1 ngày</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Thành tiền (VNĐ) :</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <td>Đơn giá</td>
                                    <td><strong><span id="price-day">0</span> VND/ 1 ngày</strong></td>
                                </tr>
                                <tr>
                                    <td>Phí dịch vụ đăng tin</td>
                                    <td><strong><span id="fee-day">0</span> VND</strong></td>
                                </tr>
                                <tr>
                                    <td>Phí bao gồm VAT (10%)</td>
                                    <td><strong><span id="fee-vat">0</span> VND</strong></td>
                                </tr>
                                <tr>
                                    <td>Khuyến mại</td>
                                    <td><strong><span id="khuyen-mai">0</span> VND</strong></td>
                                </tr>
                                <tr>
                                    <td>Tổng tiền</td>
                                    <td><strong><span id="total-money">0</span> VND</strong></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div id="ContentPlaceHolder1_PostNews_divCaptcha" class="row">
                    <div class="col-sm-3"><label>Mã an toàn <span>(*)</span>:</label></div>
                    <div class="col-sm-9">
                        <input name="txtcode" type="text" maxlength="4" id="txtcode" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-9 col-sm-offset-3 submitbds">
                        <div class="row">
                            <div class="col-sm-4">
                                <?= Html::submitButton('Đăng tin', ['class' =>'btnpost btn']) ?>
                            </div>
                            <div class="col-sm-4"><a id="lbtCancel" class="btncancel btn" href="#">Hủy bỏ</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<div id="fileupload" style="display: none;">
    <div id="uploadimage" class="clearfix default-theme">
        <form id="uploadForm" action="upload.php" method="post">
            <input id="secleimg" multiple="" class="fileupload" type="file" name="userImage">
        </form>
    </div>
</div>