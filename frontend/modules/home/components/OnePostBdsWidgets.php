<?php

namespace frontend\modules\home\components;

use yii\base\Widget;

class OnePostBdsWidgets extends Widget {

    public $model;

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        if ($this->model) {
            return $this->render('one_post_batdongsan',['model'=>  $this->model]);
        }
    }

}
?>

