<div class="list-image">
    <?php
    foreach ($model as $value){
        echo \backend\modules\posts\components\images\OneImageSliderWidgets::widget(['model'=>$value]);
    }
    ?>
    
    <div class="clearfix"></div>
</div>
<a  onclick="showPopupImage('#input-form-id-image', '.img-thumbnail-my',1);" id="chonanh">Chọn ảnh đại diện</a>