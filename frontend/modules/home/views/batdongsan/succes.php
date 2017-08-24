<?php
use common\func\FunctionCommon;
use yii\helpers\Url;

?>
<?= \frontend\modules\home\components\member\LeftInfoWidgets::widget() ?>
<div class="col-md-9">
    <div class="postnews">
        <div id="ContentPlaceHolder1_PostNews_pnDangtin">
            <div class="pn-content">
                <div class="post">
                    <p class="p-i-title">
                        Tin đăng mã <?= $model->ShowID() ?> của bạn đã được gửi lên hệ thống
                        <a class="text-blue" target="_blank" href="<?= Url::to(['/']) ?>"><b>Nhadathd.vn</b></a> vào lúc <b><?= date("H:i",strtotime($model->ngay_tao)) ?></b> ngày <b><?= date("d/m/Y",strtotime($model->ngay_tao)) ?>.</b>
                    </p>
                    <div class="table-post">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-4 column col-left">Mã đăng tin</div>
                                <div class="col-sm-8 column col-right p-red"><?= $model->ShowID() ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-4 column col-left">Loại tin</div>
                                <div class="col-sm-8 column col-right"><?= $model->fee ? $model->fee->name : ''; ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-4 column col-left">Thời gian đăng tin</div>
                                <div class="col-sm-8 column col-right"><?= $transition->count_day; ?> ngày</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-4 column col-left">Phí đăng tin</div>
                                <div class="col-sm-8 column col-right"> <?= FunctionCommon::formatMoney($model->fee ? $model->fee->price : 0) ?> VNĐ/ngày</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-4 column col-left">Tổng chi phí thanh toán</div>
                                <div class="col-sm-8 column col-right p-bold"><?= FunctionCommon::formatMoney($transition->money) ?> VNĐ</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-i-thanks">Cảm ơn bạn đã tin tưởng sử dụng dịch vụ của <a target="_blank" class="text-blue" href="<?= Url::to(['/']) ?>"><b>Nhadathd.vn</b></a></div>
                    <div class="p-i-payment-methods">
                        <p>
                            <br>
                            Quý khách vui lòng thanh toán để tin rao được <strong>HIỂN THỊ</strong> trên website nhadathd.vn
                        </p>
                        <a class="btnLogin" href="<?= Url::to(['/']) ?>">ĐÓNG</a>
                    </div>
                    <div class="border row"></div>
                    <div class="contact">
                        Chúng tôi luôn sẵn sàng giải đáp mọi thắc mắc của bạn. Nếu có bất kỳ khó khăn nào trong việc sử dụng website nói chung, hãy liên hệ với chúng tôi theo số điện thoại: <b>0903.236.862</b> hoặc email: <b><a rel="nofollow" href="mailto:cskh@info@dothi.net?Subject=Li%C3%AAn%20h%E1%BB%87-info@dothi.net" target="_top">info@dothi.net</a></b>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .table-post{border: 1px solid #ddd; border-bottom: none;}
.table-post .row div.column{border: 1px solid #ddd;border-right: none;
    border-top:none;background: #e2f5ff;padding: 10px;}
.table-post .row div.col-left{border-left: none;}
    .p-i-thanks{margin-top: 10px;}
    .p-i-payment-methods .btnLogin{width: 200px;margin: 0 auto;display: block;line-height: 20px;}
    .border{border-bottom: 1px solid #ddd;margin-top: 10px;}
    .pn-content .contact{margin-top: 10px;margin-bottom: 10px;}
    .p-red{color: red;}
    .p-bold{font-weight: bold;color: #00a65a}
</style>