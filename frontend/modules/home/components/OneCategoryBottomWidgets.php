<?php

namespace frontend\modules\home\components;

use yii\base\Widget;

class OneCategoryBottomWidgets extends Widget {

    public $categories;
    public $className = 'equalheight3';

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        return $this->render('one_category_bottom',['categories'=>  $this->categories,'className'=>  $this->className]);
    }

}
?>

