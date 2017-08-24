<?php

use yii\helpers\Url;

?>
<div class="col-md-3">
    <!-- Hướng dẫn  -->
    <div class="menu-user">
        <div class="mu-userinfo">
            <div class="avatar">
                <?= $member->getAvatar() ?>
            </div>
            <div class="display-name">Nhữ Tuấn Anh</div>
            <div class="budget">
                <span class="main-acc">
                    <span>TK chính</span>:
                    <b>0 VND</b>
                </span>
                <span class="promotion-acc" id="promotion-acc-1">
                    <span>TK KM1</span>:
                    <b>0 VND</b>
                 </span>
                <span class="promotion-acc" id="promotion-acc-2">
                    <span>TK KM2</span>:
                    <b>0 VND</b>
                </span>
                <span class="promotion-acc" id="promotion-acc-3">
                    <span>TK KM3</span>:
                    <b>0 VND</b>
                </span>
            </div>
        </div>
        <div class="mu-title">
            <h3>Thông tin tài khoản</h3>
        </div>
        <ul>
            <li class="lead"><a href="#">Thông báo
                    <span style="color:#fa6d1d"> (1) </span></a></li>
            <li class="lead"><a href="#">Quản lý tài khoản</a></li>
            <li><a href="<?= Url::to(['/home/member/change-info']) ?>">Thay đổi thông tin cá nhân</a></li>
            <li><a href="<?= Url::to(['/home/member/change-password']) ?>">Thay đổi mật khẩu</a></li>
            <li class="lead"><a href="#">Quản lý tin rao</a></li>
            <li><a href="#">Đăng tin rao bán/cho thuê</a></li>
            <li class="active"><a href="#">Quản lý tin rao bán/cho thuê</a></li>
            <li><a href="#">Quản lý tin rao đã lưu</a></li>
            <li><a href="#">Quản lý tin nháp</a></li>
            <li><a href="#">Quản lý đăng ký nhận BĐS qua email</a></li>
            <div id="ContentPlaceHolder1_BoxMenu1_divBranchUserRequest">
                <li class="lead"><a href="#">Tài khoản nhánh</a></li>
                <li><a target="_blank" href="#">Hướng dẫn đăng ký Tính năng QL TK nhánh</a></li>
                <li id="mnUpgradeAcc"><a href="#">Yêu cầu tính năng TK nhánh</a></li>
            </div>
            <li class="lead"><a href="javascript:">Thông tin giao dịch</a></li>
            <li><a href="#">Gói tin</a></li>
            <li><a href="#">Lịch sử giao dịch</a></li>
            <li id="mnChargeMoney"><a href="#">Nạp tiền</a></li>
            <li class="lead"><a href="#">Khuyến mại </a></li>
            <li><a href="#">Quản lý khuyến mại</a></li>
            <li class="lead"><a href="#">Báo giá</a></li>
            <li class="lead"><a href="#">Hướng dẫn sử dụng</a>
            </li>
        </ul>
    </div>
</div>