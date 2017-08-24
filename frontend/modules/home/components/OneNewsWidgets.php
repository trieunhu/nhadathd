<?php

namespace frontend\modules\home\components;

use yii\base\Widget;

class OneNewsWidgets extends Widget {

    public $model;

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        if ($this->model) {
            return $this->render('one_news',['model'=>  $this->model]);
        }
    }

}
?>

