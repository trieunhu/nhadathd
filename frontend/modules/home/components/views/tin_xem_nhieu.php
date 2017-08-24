<?= $div_ngoai != '' ? '' : '<div class="col-sm-4">';?>
    <div class="box-style2" id="tin_xem_nhieu">
        <div class="title"><h3><?= $categoryXemnhieu->title ?></h3></div>
        <ul class="danhsach_tin danhsach_tin_b">
            <?php for ($i = 0; $i < count($postXemnhieu); $i++): ?>
                <li><?= $postXemnhieu[$i]->getTitle(); ?></li>
            <?php endfor; ?>
        </ul>
    </div>
<?= $div_ngoai != '' ? '' : '</div>';?>