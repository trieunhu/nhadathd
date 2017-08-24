<?= frontend\modules\home\components\ListTitleCategoryWidgets::widget(['parent' => $parent, 'model' => $model->menu]); ?>
<?= frontend\modules\home\components\OneCategoryTopWidgets::widget(['category'=>$model]) ?>
<?php 
    $arrEnd = [];
    $i = 0;
    $countEnd = $count - 3;
    
    foreach ($parent->childs as $value) {
        if ($i >= $countEnd) {
            $arrEnd[] = $value;
        }  else {
//            die('count end '.$countEnd);
            echo \frontend\modules\home\components\OneCategoryCenterWidgets::widget(['category'=>$value->category]);
        }
        $i++;
    }
    echo \frontend\modules\home\components\OneCategoryBottomWidgets::widget(['categories'=>$arrEnd]);
?>