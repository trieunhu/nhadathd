<?php

namespace frontend\modules\home\components\member;
use frontend\models\Menu;
use yii\base\Widget;

class NoticeMemberWidgets extends Widget {

    public $category;

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        return $this->render('notice_member');
    }

}
?>

