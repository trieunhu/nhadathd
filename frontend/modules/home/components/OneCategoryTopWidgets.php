<?php

namespace frontend\modules\home\components;

use yii\base\Widget;

class OneCategoryTopWidgets extends Widget {

    public $category;
    public $className = 'equalheight1';
    public $posts;

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        return $this->render('one_category_top',['category'=>  $this->category,'className'=>  $this->className,'posts'=>  $this->posts]);
    }

}
?>

