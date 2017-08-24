<div class="col-sm-6" style="padding-right:7px">
    <div class="box-style4" id="tu_van_luat">
        <div class="title"><h3><?= $category->title ?></h3></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box-feature-left">
                    <?php
                    if (count($posts) > 0) {
                        if ($linkImage) {
                            echo $posts[0]->getHinhAnh();
                        } else {
                            echo $posts[0]->getHinhAnhLink();
                        }
                        echo $posts[0]->getTitle();
                    }
                    ?>
                </div>
            </div>
            <div class="col-xs-12" >
                <div class="box-feature-right">
                    <?php if (count($posts) > 1): ?>
                        <ul class="danhsach_tin">
                            <?php for ($i = 1; $i < count($posts); $i++): ?>
                                <li><?= $posts[$i]->getTitle(); ?></li>
                            <?php endfor; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>