<option value="" selected="selected">Quận/Huyện</option>
<?php foreach ($model->districts as $value): ?>
    <option value="<?= $value->districtid ?>"><?= $value->name ?> </option>
<?php endforeach; ?>
