<?php

namespace backend\modules\config\controllers;

use backend\modules\config\models\ConfigApp;
use yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class ConfigappController extends \yii\web\Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['manageAll'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $model = new ConfigApp();
        $model->baseUrl = ConfigApp::getValueConfig("baseUrl");
        $model->nameApp = ConfigApp::getValueConfig("nameApp");
        $model->content_footer = ConfigApp::getValueConfig("content_footer");
        $arrdiadiem = json_decode(ConfigApp::getValueConfig("diadiemdefault"));
        if ($arrdiadiem) {
            $model->tinh_id = $arrdiadiem->tinh;
            $model->huyen_id = $arrdiadiem->huyen_id;
            $model->xa_id = $arrdiadiem->xa;
        }
        if ($model->load(Yii::$app->request->post())) {
            ConfigApp::setValueConfig("baseUrl", $model->baseUrl);
            ConfigApp::setValueConfig("nameApp", $model->nameApp);
            ConfigApp::setValueConfig("content_footer", $model->content_footer);
            $arrsDiadiem = ['tinh' => $model->tinh_id, 'huyen_id' => $model->huyen_id, 'xa' => $model->xa_id];
            ConfigApp::setValueConfig("diadiemdefault", json_encode($arrsDiadiem));
        }
        return $this->render('index', [
                    'model' => $model,
        ]);
    }

}
