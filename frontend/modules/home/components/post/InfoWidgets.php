<?php

namespace frontend\modules\home\components\post;
use yii\base\Widget;
use common\models\MemberProfile;
class InfoWidgets extends Widget {
    public $model;
    public $category;
    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        $titleCategory = "Loại bán đất";
        if (!$this->category){
            $this->category = $this->model->getCategories()->one();
        }
        if ($this->category){
            $titleCategory = $this->category->getTitle();
        }
        $profile = $this->model->member;
        return $this->render('info',['model'=>$this->model,'titleCategory'=>$titleCategory,'profile'=>$profile]);
    }

}
?>

