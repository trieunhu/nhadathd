<?php

namespace frontend\modules\home\components\member;
use frontend\models\Menu;
use yii\base\Widget;

class LeftInfoWidgets extends Widget {

    public $category;

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        $menu = Menu::findOne(['type'=>'huong-dan-su-dung']);
        return $this->render('left_info',['menu'=>$menu]);
    }

}
?>

