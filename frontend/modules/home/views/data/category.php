<option value="" selected="selected">Loại bất động sản</option>
<?php foreach ($model as $key => $value): ?>
    <?php
        $class = '';
        if (strpos($value,"+") !== false){
            $class ='class="item-child"';
        }
    ?>
    <option value="<?= $key ?>" <?= $class ?>><?= $value ?> </option>
<?php endforeach; ?>
