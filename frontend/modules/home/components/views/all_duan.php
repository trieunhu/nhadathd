<section id="right-slider">
        <!-- slide -->
        <div class="title"><h3>DỰ ÁN NỔI BẬT</h3></div>
        <div id="duan" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#duan" data-slide-to="0" class="active"></li>
                <li data-target="#duan" data-slide-to="1" class=""></li>
                <li data-target="#duan" data-slide-to="2" class=""></li>
            </ol>
            <div class="carousel-inner">
                <?php 
                    if (count($model) > 1) {
                        for ($index = 0; $index < count($model); $index++) {
                            $active = $index == 0 ? 'active' : '';
                            echo frontend\modules\home\components\OneDuanWidgets::widget(['active'=>  $active,'model'=>$model[$index]]);
                        }
                    }
                ?>
            </div>
            <a class="left carousel-control" href="#duan" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control" href="#duan" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </div><!-- /slide -->
        <div class="row">
            <div class="col-xs-12">
                <ul>
                    <?php 
                    if (count($model) > 3) {
                        for ($index = 3; $index < count($model); $index++) {
                            echo frontend\modules\home\components\OneDuanWidgets::widget(['type'=>  'li','model'=>$model[$index]]);
                        }
                    }
                ?>
                </ul>
            </div>
        </div>
    </section>