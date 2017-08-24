<?php

namespace frontend\modules\home\components;

use yii\base\Widget;

class OneCategoryPostWidgets extends Widget {

    public $category;
    public $posts;

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        if ($this->category) {
            return $this->render('one_category_post',['category'=>  $this->category,'posts'=>  $this->posts]);
        }
    }

}
?>

