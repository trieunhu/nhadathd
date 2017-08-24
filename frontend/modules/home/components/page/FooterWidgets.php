<?php

namespace frontend\modules\home\components\page;
use yii\base\Widget;
use frontend\models\Menu;
use common\models\Banner;
use common\func\StaticDefine;
class FooterWidgets extends Widget {


    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        $bannerTop = Banner::findOne(['position'=>'right_footer']);
        $bannerLeft = Banner::findOne(['position'=>'top_header_left']);
        $menu = Menu::findOne(['type'=>  StaticDefine::$FOOTER_MENU]);
        return $this->render('footer',['menu'=>$menu,'bannerTop'=>$bannerTop,'bannerLeft'=>$bannerLeft]);
    }

}
?>

