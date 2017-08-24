
<div class="row">
    <?php
        foreach ($categories as $value) {
            if ($value->tableName() == common\models\Category::tableName()) {
                $category = $value;
            }  else {
                $category = $value->category;
            }
            echo \frontend\modules\home\components\OneCategoryWidgets::widget(['category'=>$category,'className'=>  $className]);
        }
    ?>
</div>