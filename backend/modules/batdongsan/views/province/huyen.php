<option value="default" selected="selected">Chọn huyện </option>
<?php foreach ($model->districts as $value): ?>
    <option value="<?= $value->districtid ?>"><?= $value->name ?> </option>
<?php endforeach; ?>
