<?php

namespace frontend\modules\home\components;

use yii\base\Widget;

class OneCategoryCenterWidgets extends Widget {

    public $category;
    public $className = 'equalheight2';
    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        return $this->render('one_category_center',['category'=>  $this->category,'className'=>  $this->className]);
    }

}
?>

