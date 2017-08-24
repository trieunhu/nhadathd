<?php

namespace frontend\modules\home\components\post;
use yii\base\Widget;
class CommentWidgets extends Widget {


    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        return $this->render('comment');
    }

}
?>

