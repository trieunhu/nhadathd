<?php

namespace backend\modules\posts\controllers;

use Yii;
use backend\modules\posts\models\Images;
use backend\modules\posts\models\ImagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\posts\models\Taxonomy;
use yii\imagine\Image;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\Trangthai;
use common\func\FunctionCommon;
use common\func\StaticDefine;
use yii\filters\AccessControl;

/**
 * ImagesController implements the CRUD actions for Images model.
 */
class ImagesController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'update', 'delete', 'filerindex', 'getimage', 'saveimage', 'postimages'],
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

    public function actionFilerindex() {
        if (isset($_POST['ids']) && isset($_POST['action'])) {
            $data = json_decode(stripslashes($_POST['ids']));
            $action = $_POST['action'];
            foreach ($data as $d) {
                $model = Images::findOne(['id' => $d]);
                $trangthai = Trangthai::findOne(['id' => $action]);
                if ($model && $trangthai) {
                    if ($trangthai->thuoc_tinh == -1) {
                        $model->Xoa();
                    }
                }
            }
        }
    }

    /**
     * Lists all Images models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ImagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $linkAjax = Url::to(["/posts/images/filerindex"]);
        $dataListAction = ArrayHelper::map(Trangthai::find()->where(['type' => "Images"])->all(), 'id', 'ten');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataList'=>$dataListAction,
            'linkAjax'=>$linkAjax
        ]);
    }

    public function actionGetimage() {
        $images = Images::find()->orderBy(['id' => SORT_DESC])->all();
        echo $this->renderPartial("ajax_get_image", ['images' => $images,'type'=>'list']);
    }

    public function actionSaveimage() {
        $arrId = isset($_POST['listID']) ? $_POST['listID'] : [];
        $slider = isset($_POST['slider']) ? $_POST['slider'] : 0;
        if (count($arrId) > 0) {
            $images = Images::find()->where(['id'=>$arrId])->all();
            if ($slider == 2) {
                $data = [];
                foreach ($images as $value) {
                    $data[] = $value->getUrl();
                }
                return json_encode($data);
            }else {
                $data['html'] = $this->renderPartial("ajax_get_image", ['images' => $images,'type'=>'listslider']);
                $data['status'] = "s";
                return \yii\helpers\Json::encode($data);
            }
        }else if (isset($_POST['id_image'])) {
            $id = $_POST['id_image'];
            $title = $_POST['title_image'];
            $alt = $_POST['alt_image'];
            $description = $_POST['description_image'];
            $model = Images::findOne(['id' => $id]);
            if ($model) {
                $model->title = $title;
                $model->description = $description;
                $model->alt = $alt;
                $model->save();
                $json = ['urlimage' => $model->getUrl(), 'id' => $model->id,'status'=>'i'];
                return \yii\helpers\Json::encode($json);
            }
        }
    }

    public function actionPostimages() {
        echo 0;
        if (isset($_FILES) && isset($_FILES['userImage'])) {
            if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
                $sourcePath = $_FILES['userImage']['tmp_name'];
                $nameImage = str_replace(' ', '', $_FILES['userImage']['name']);
                $name =  @current(explode('.', $nameImage));
                $type = @end(explode('.', $nameImage));
                $nameFile =   FunctionCommon::random_code(16).".$type";
                $fileSave = $nameFile;
                $path = FunctionCommon::createFolder(Yii::getAlias("@pathimage"));
                $targetPath = $path . $fileSave;
                if (move_uploaded_file($sourcePath, $targetPath)) {
                    $model = new Images();
                    $model->author_id = \Yii::$app->user->id;
                    $model->title = $name.".".$type;
                    $urlFile = FunctionCommon::getURLImage();
                    $model->url = $urlFile;
                    $model->file = $nameFile;
                    $model->save();
                    $fileSize = filesize($targetPath);
                    $size = FunctionCommon::formatSizeUnits($fileSize);
                    if ($fileSize > (1024 * 100) || $type != 'gif') {
                        Image::frame($targetPath, 0, '666', 0)->save($targetPath, ['quality' => 60]);
                    }

                    list($w, $h) = getimagesize($targetPath);
                    if ($w > 1000){
                        $h1 = floor($h/$w * 1000);
                        Image::frame($targetPath, 5, '666', 0)->thumbnail(new \Imagine\Image\Box(1000,$h1))->save($targetPath);
                    }

                    $jsons = ["size" => $size,'width' => $w, "height" => $h, "type" => $type];
                    Taxonomy::setTaxonomy($model->id, "images", StaticDefine::$CHI_TIET_HINH_ANH, json_encode($jsons));
                    echo $this->renderPartial('_ajax_post_image', ['image' => $model]);
                }
            }
        }
    }

    /**
     * Displays a single Images model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Images model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Images();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Images model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Images model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        if ($model) {
            $model->Xoa();
        }
        if (Yii::$app->request->isAjax) {
            echo $id;
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Images model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Images the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Images::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
