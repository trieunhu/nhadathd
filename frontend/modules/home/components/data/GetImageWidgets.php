<?php

namespace frontend\modules\home\components\data;
use yii\base\Widget;

class GetImageWidgets extends Widget {

    public $image;

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        return $this->render('get_image',[
            'image'=>$this->image
        ]);
    }

}
?>

