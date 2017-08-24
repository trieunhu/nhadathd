<?php

namespace frontend\modules\home\components\member;
use common\models\Member;
use frontend\models\Menu;
use yii\base\Widget;

class LeftMemberWidgets extends Widget {

    public $category;

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        $member = Member::findOne(\Yii::$app->user->id);
        if ($member){
            return $this->render('left_member',['member'=>$member]);
        }
    }

}
?>

