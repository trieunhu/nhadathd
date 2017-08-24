<?= frontend\modules\home\components\ListTitleCategoryWidgets::widget(['parent' => $parent, 'model' => $model->menu]); ?>
<?= frontend\modules\home\components\OneCategoryTopWidgets::widget(['category'=>$model]) ?>
<?php
    foreach ($parent->childs as $value) {
        echo \frontend\modules\home\components\OneCategoryCenterWidgets::widget(['category'=>$value->category]);
    }
?>