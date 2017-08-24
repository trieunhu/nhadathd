<?php

namespace frontend\modules\home\components;

use yii\base\Widget;

class OneDuanWidgets extends Widget {

    public $type;
    public $active;
    public $model;

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        return $this->render('one_duan',['active'=>  $this->active,'type'=>  $this->type,'model'=>  $this->model]);
    }

}
?>

