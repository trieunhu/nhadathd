<?php

namespace frontend\modules\home\components;
use yii\base\Widget;

class NhanTinBdsWidgets extends Widget {

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        return $this->render('nhan_tin_bds');
    }

}
?>

