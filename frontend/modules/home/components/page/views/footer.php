<footer>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="container">
                <div class="row">				
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <?= yii\widgets\Menu::widget($menu->getMenu());?>
                    </div><!-- /.navbar-collapse -->
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <?= $bannerTop->getValue() ?>
            </div>
            <div class="col-sm-5">
               <?php echo \common\models\Config::getValueConfig('content_footer') ?>
            </div>
            <div class="col-sm-4">
                <div class="app_footer">
                    <p>Tải ứng dụng di động</p>
                    <p>
                        <a class="mr10" target="_blank" href="#">
                            <img src="http://nhadathd.vl/uploads/bdshd/app-android-dl.png" class="img-responsive">
                        </a>
                        <a href="#" rel="nofollow" target="_blank">
                            <img src="http://nhadathd.vl/uploads/bdshd/app-ios-dl.png" class="img-responsive">
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>