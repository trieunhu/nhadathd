<?php
use yii\helpers\Url;
?>
<header id="header" class="header hidden-phone">
    <!-- Top-menu -->
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="pull-right">
                        <?php if(Yii::$app->user->isGuest): ?>
                        <li><a href="<?= Url::to(['/home/member/register']) ?>"><i class="fa fa-registered"></i> Đăng ký </a></li>
                        <li><a href="<?= Url::to(['/home/member/login']) ?>"><i class="fa fa-user"></i> Đăng nhập</a></li>
                        <?php else: ?>
                            <li><a href="<?= Url::to(['/home/member/index']) ?>"><i class="fa fa-user"></i><?= Yii::$app->user->identity->display_name ?></a></li>
                            <li><a href="<?= Url::to(['/home/member/logout']) ?>"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- /Top-menu -->
    <!-- Logo va banner -->
    <div class="logo_banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="logo">
                        <?= $bannerTop->getValue() ?>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="banner pull-right">
                        <?= $bannerLeft->getValue() ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /Logo va banner -->

    <!-- Menu chinh -->
    <nav class="navbar navbar-default" role="navigation" id="stickymenu" >
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <?= yii\widgets\Menu::widget($menu->getMenu());?>
                    </div><!-- /.navbar-collapse -->
                </div>
            </div>
        </div>
    </nav>
    <!-- /Menu chinh -->
</header><!-- /header -->