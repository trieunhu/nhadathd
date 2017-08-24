<?php

namespace frontend\modules\home\controllers;
use common\models\Province;
use frontend\modules\home\models\SearchForm;
use yii\web\Controller;
use Yii;
use common\models\Images;
use yii\imagine\Image;
use common\models\Taxonomy;
use common\func\FunctionCommon;
use common\func\StaticDefine;
class DataController extends Controller
{
    public $enableCsrfValidation = false;
    public function actionUpImage(){
        if (isset($_FILES) && isset($_FILES['userImage'])) {
            if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
                $sourcePath = $_FILES['userImage']['tmp_name'];
                $nameImage = str_replace(' ', '', $_FILES['userImage']['name']);
                $type = @end(explode('.', $nameImage));
                $name =   FunctionCommon::random_code(16).".$type";
                $fileSave = str_replace(' ', '', $_FILES['userImage']['name']);
                $path = FunctionCommon::createFolder(Yii::getAlias("@pathimage"));
                $targetPath = $path .  $name;
                if (move_uploaded_file($sourcePath, $targetPath)) {

                    $model = new Images();
                    $model->author_id = 0;
                    $model->title =$nameImage;
                    $urlFile = FunctionCommon::getURLImage();
                    $model->url = $urlFile;
                    $model->file = $name;
                    $model->status = Images::STATUS_TEMP;
                    $model->save();
                    list($w, $h) = getimagesize($targetPath);
                    if ($w > 1000){
                        $h1 = floor($h/$w * 1000);
                        Image::frame($targetPath, 5, '666', 0)->thumbnail(new \Imagine\Image\Box(1000,$h1))->save($targetPath);
                    }
                    $fileSize = filesize($targetPath);
                    $size = \common\func\FunctionCommon::formatSizeUnits($fileSize);
                    $jsons = ["size" => $size,'width' => $w, "height" => $h, "type" => $type];
                    Taxonomy::setTaxonomy($model->id, "images", StaticDefine::$CHI_TIET_HINH_ANH, json_encode($jsons));

                    echo $this->renderPartial('_ajax_post_image', ['image' => $model]);
                }
            }
        }
    }
    public function actionHuyen() {
        if (isset($_POST["id"])) {
            $type = $_POST['type'];
            if ($type == 'huyen'){
                $id = $_POST["id"];
                $model = Province::find()->where(["provinceid" => $id])->one();
                if ($model) {
                    return $this->renderPartial('huyen', ['model' => $model]);
                }
            }else{
                $id = $_POST["id"];
                $model = \common\models\District::find()->where(["districtid" => $id])->one();
                if ($model) {
                    return $this->renderPartial('xa', ['model' => $model]);;
                }
            }
        }
    }
    public function actionCategory() {
//        $_POST["id"] = 14;
        if (isset($_POST["id"])) {
            $model = SearchForm::getCategories($_POST['id'])[0];
            if ($model) {
                return $this->renderPartial('category', ['model' => $model]);;
            }
        }
    }
}
