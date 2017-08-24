<?php

namespace frontend\modules\home\components;

use yii\base\Widget;

class TwoCategoryPostWidgets extends Widget {

    public $categories;

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        if ($this->categories) {
            return $this->render('two_category',['categories'=>  $this->categories]);
        }
    }

}
?>

