<?php

namespace frontend\modules\home\components;
use common\models\Duan;
use yii\base\Widget;

class NguoiBanTieuBieuWidgets extends Widget {

    public $category;

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        $model = Duan::find()->all();
        return $this->render('nguoi_ban_tieu_bieu',['model'=>$model]);
    }

}
?>

