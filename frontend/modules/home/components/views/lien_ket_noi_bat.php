<!-- Link lien ket -->
<section id="lien_ket_noi_bat">
    <div class="row">
        <div class="col-xs-12">
            <div class="title"><h3>LIÊN KẾT NỔI BẬT</h3></div>
        </div>
        <div class="col-xs-12">
            <?php if(count($model) > 0): ?>
            
            <ul id="ulBoxHotHome" class="danhsach_tin danhsach_tin_b">
                <?php foreach ($model as $value): ?>
                <li>
                    <?= $value->getLink() ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <a href="#" class="btn btn-success pull-right">Xem tất cả</a>
        </div>
    </div>							
</section><!-- /Link lien ket -->