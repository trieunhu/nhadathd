<?php

namespace backend\modules\batdongsan\controllers;

use Yii;
use backend\modules\batdongsan\models\Chudautu;
use backend\modules\batdongsan\models\ChudautuSearch;
use backend\modules\posts\models\ConfigApp;
use backend\modules\posts\models\PostRelationships;
use backend\modules\posts\models\Images;
use backend\modules\posts\models\Taxonomy;
use common\models\Diadiem;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * ChudautuController implements the CRUD actions for Chudautu model.
 */
class ChudautuController extends \backend\controllers\BackendController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'roles' => ['managePost'],
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

    /**
     * Lists all Chudautu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChudautuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Chudautu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Chudautu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Chudautu();
        $arrdiadiem = json_decode(ConfigApp::getValueConfig("diadiemdefault"));
        if ($arrdiadiem) {
            $model->tinh_id = $arrdiadiem->tinh;
            $model->huyen_id = $arrdiadiem->huyen_id;
            $model->xa_id = $arrdiadiem->xa;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->createPosts($model, FALSE, FALSE);
            $model->slug = Taxonomy::createSlug($model->id, $model->ten, Chudautu::tableName());
            $model->save();
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Chudautu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->dia_diem) {
            $model->tinh_id = $model->dia_diem->tinh_id;
            $model->xa_id = $model->dia_diem->xa_id;
            $model->huyen_id = $model->dia_diem->huyen_id;
            $model->diadiem = $model->dia_diem->ten;
        }
        $model->getSeoPost();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            PostRelationships::deleteAll(['post_id' => $model->id, 'post_table' => Chudautu::tableName()]);
            $this->createPosts($model, FALSE, FALSE);
            $model->slug = Taxonomy::createSlug($model->id, $model->slug, Chudautu::tableName(),FALSE);
            $model->save();
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Chudautu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model) {
            $model->Xoa();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Chudautu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Chudautu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chudautu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
