<option value="default" selected="selected">Chọn loại </option>
<?php foreach ($model->loais as $value): ?>
    <option value="<?= $value->id ?>"><?= $value->ten ?> </option>
<?php endforeach; ?>
