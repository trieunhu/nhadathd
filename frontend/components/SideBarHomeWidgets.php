<?php
namespace frontend\components;

use yii\base\Widget;
use common\models\Banner;

class SideBarHomeWidgets extends Widget{
    public function init(){
            // add your logic here
            parent::init();
    }
    public function run(){
        $banner = Banner::findOne(['position'=>'sidebar_right_centrer']);
        return $this->render('sidebar_home',['banner'=>$banner]);
    }
}
?>

