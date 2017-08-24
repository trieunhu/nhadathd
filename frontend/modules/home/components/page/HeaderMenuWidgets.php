<?php

namespace frontend\modules\home\components\page;
use yii\base\Widget;
use frontend\models\Menu;
use common\models\Banner;
use common\func\StaticDefine;

class HeaderMenuWidgets extends Widget {


    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        $bannerTop = Banner::findOne(['position'=>'top_header']);
        $bannerLeft = Banner::findOne(['position'=>'top_header_left']);
        $menu = Menu::findOne(['type'=>  StaticDefine::$HEADER_MENU]);
//        die(var_dump(\Yii::$app->user));
        return $this->render('header_menu',['menu'=>$menu,'bannerTop'=>$bannerTop,'bannerLeft'=>$bannerLeft]);
    }

}
?>

