<?php

namespace frontend\modules\home\components;
use common\models\Duan;
use yii\base\Widget;

class AllDuanWidgets extends Widget {

    public $category;

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        $model = Duan::find()->all();
        return $this->render('all_duan',['model'=>$model]);
    }

}
?>

