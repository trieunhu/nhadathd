<option value="default" selected="selected">Chọn xã </option>
<?php foreach ($model->wards as $value): ?>
    <option value="<?= $value->wardid ?>"><?= $value->name ?> </option>
<?php endforeach; ?>
