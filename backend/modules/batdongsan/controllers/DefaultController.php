<?php

namespace backend\modules\batdongsan\controllers;

use common\models\District;
use common\models\Province;
use common\models\Ward;
use Yii;
use backend\modules\posts\models\Images;
use \backend\modules\posts\models\PostRelationships;
use backend\modules\batdongsan\models\Batdongsan;
use backend\modules\batdongsan\models\BatdongsanSearch;
use backend\modules\config\models\ConfigApp;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Slug;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\modules\config\models\Trangthai;
/**
 * DefaultController implements the CRUD actions for Batdongsan model.
 */
class DefaultController extends \backend\controllers\BackendController {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'filerindex', 'update', 'delete', 'xoa', 'phanloai'],
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
     * Lists all Batdongsan models.
     * @return mixed
     */
    public function actionIndex($filer = 0,$type = '') {
//        die('vao day');
        $searchModel = new BatdongsanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $filer);
        $linkAjax = Url::to(['/batdongsan/default/filerindex']);
        $countAll = Batdongsan::find()->count();
        $countNotActive = Batdongsan::find()->where(['status' => Batdongsan::STATUS_DRAFT])->count();
        $countTake = Batdongsan::find()->where(['status' =>Batdongsan::STATUS_TRASH])->count();
        $countTemp = Batdongsan::find()->where(['status' =>Batdongsan::STATUS_TEMP])->count();
        $arrTitle = [
            ['count'=>$countAll,'title'=>'Tất cả','filer'=>0,'type'=>$type],
            ['count'=>$countTemp,'title'=>'Chưa duyệt','filer'=>Batdongsan::STATUS_TEMP,'type'=>$type],
            ['count'=>$countNotActive,'title'=>'Bản nháp','filer'=>  Batdongsan::STATUS_DRAFT  ,'type'=>$type],
            ['count'=>$countTake,'title'=>'Thùng rác','filer'=>Batdongsan::STATUS_TRASH,'type'=>$type],
        ];
        $dataListAction = ArrayHelper::map(Trangthai::find()->where(['type' => "filerindex".$filer])->all(), 'id', 'ten');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'filer' => $filer,
            'type' => $type,
            'arrTitle'=>$arrTitle,
            'dataProvider' => $dataProvider,
            'dataList'=>$dataListAction,
            'linkAjax'=>$linkAjax
        ]);

    }

    public function actionFilerindex() {
        if (isset($_POST['ids']) && isset($_POST['action'])) {
            $data = json_decode(stripslashes($_POST['ids']));
            $action = $_POST['action'];
            foreach ($data as $d) {
                $model = Batdongsan::findOne(['id' => $d]);
                $trangthai = \common\models\Trangthai::findOne(['id' => $action]);
                if ($model && $trangthai) {
                    $trangthai = Trangthai::findOne(['id' => $action]);
                    if ($model && $trangthai) {
                        $value = $trangthai->getValue();
                        if ($value == -1) {
                            $model->_delete();
                        } else {
                            $feild = $trangthai->getFeild();
                            if (!empty($feild)) {
                                $model->$feild = $value;
                                $model->save(false);
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Displays a single Batdongsan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    function createPosts($model, $isCategory = true, $isUseCategory = true, $isDiaDiem = TRUE) {
        parent::createPosts($model);
        if (isset($_POST['slider'])) {
            $images = $_POST['slider'];
            foreach ($images as $value) {
                $imageModel = Images::findOne(['id' => $value]);
                if ($imageModel) {
                    PostRelationships::setPost($imageModel->id, $model->id, "slider", $model->tableName());
                }
            }
        }
        
    }

    /**
     * Creates a new Batdongsan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Batdongsan();
        $arrdiadiem = json_decode(ConfigApp::getValueConfig("diadiemdefault"));
        if ($arrdiadiem) {
            $model->tinh_id = $arrdiadiem->tinh;
            $model->huyen_id = $arrdiadiem->huyen_id;
            $model->xa_id = $arrdiadiem->xa;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->createPosts($model);
            $model->user_id = \Yii::$app->user->id;
            Slug::create($model->id,$model->tableName(),$model->title);
            if (count($model->categoriesbds) > 0) {
                foreach ($model->categoriesbds as $value) {
                    if ($value->parent) {
                        $idparent = $value->parent->id;
                        if ($value->parent->parent) {
                            $idparent = $value->parent->parent->id;
                        } 
                        $model->loai_id = $idparent;
                        break;
                    }
                }
            }
            $model->save();
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Batdongsan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->dia_diem) {
            $model->tinh_id = $model->dia_diem->tinh_id;
            $model->xa_id = $model->dia_diem->xa_id;
            $model->huyen_id = $model->dia_diem->huyen_id;
            $model->diadiem = $model->dia_diem->ten;
        }
        $model->getSeoPost();
        $model->slug = $model->getSlug();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            PostRelationships::deleteAll(['post_id' => $model->id, 'post_table' => Batdongsan::tableName()]);
            $this->createPosts($model);
            Slug::create($model->id,$model->tableName(),$model->slug,false);
            $model->save();
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Batdongsan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        if ($model) {
            $model->Xoa();
        }
        return $this->redirect(['index']);
    }

    public function actionXoa($id) {
        $model = $this->findModel($id);
        if ($model) {
            $model->Xoa();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Batdongsan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Batdongsan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Batdongsan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
