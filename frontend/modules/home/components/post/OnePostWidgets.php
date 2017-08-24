<?php

namespace frontend\modules\home\components\post;
use yii\base\Widget;
class OnePostWidgets extends Widget {
    public $model;

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        return $this->render('one_post',['model'=>  $this->model]);
    }

}
?>

