<?php

namespace backend\modules\batdongsan\controllers;

use common\models\Province;

class ProvinceController extends \yii\web\Controller {

    public function actionHuyen() {
        if (isset($_POST["tinh"])) {
            $tinh = $_POST["tinh"];
            $model = Province::find()->where(["provinceid" => $tinh])->one();
            if ($model) {
                return $this->renderPartial('huyen', ['model' => $model]);
            }
        }
    }

    public function actionXa() {
        if (isset($_POST["tinh"])) {
            $tinh = $_POST["tinh"];
            $model = \common\models\District::find()->where(["districtid" => $tinh])->one();
            if ($model) {
                $data['html'] = $this->renderPartial('xa', ['model' => $model]);
                $data['title'] = "$model->type $model->name";
                if ($model->province) {
                    $data['title'] .= ", " . $model->province->type . " " . $model->province->name;
                }
                return \yii\helpers\Json::encode($data);
            }
        }
    }

    public function actionChonxa() {
        if (isset($_POST["tinh"])) {
            $tinh = $_POST["tinh"];
            $model = \common\models\Ward::find()->where(["wardid" => $tinh])->one();
            if ($model) {
                $data['title'] = "$model->type $model->name";
                if ($model->district) {
                    $data['title'] .= ", " . $model->district->type . " " . $model->district->name;
                    if ($model->district->province) {
                        $data['title'] .= ", " . $model->district->province->type . " " . $model->district->province->name;
                    }
                }
                return \yii\helpers\Json::encode($data);
            }
        }
    }

}
