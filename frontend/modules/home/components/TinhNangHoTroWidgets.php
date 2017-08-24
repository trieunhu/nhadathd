<?php

namespace frontend\modules\home\components;
use common\models\Duan;
use yii\base\Widget;

class TinhNangHoTroWidgets extends Widget {

    public $category;

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        $model = Duan::find()->all();
        return $this->render('tinh_nang_ho_tro',['model'=>$model]);
    }

}
?>

