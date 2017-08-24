<?php

namespace frontend\modules\home\components;

use common\models\Associate;
use common\models\Category;
use yii\base\Widget;

class LienKetNoiBatWidgets extends Widget {

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        $model = Associate::find()->limit(15)->orderBy(['views'=>SORT_DESC])->all();
        if ($model) {
            return $this->render('lien_ket_noi_bat', ['model' => $model]);
        }
    }

}
?>

