<option value="" selected="selected">Xã/Phường </option>
<?php foreach ($model->wards as $value): ?>
    <option value="<?= $value->wardid ?>"><?= $value->name ?> </option>
<?php endforeach; ?>
