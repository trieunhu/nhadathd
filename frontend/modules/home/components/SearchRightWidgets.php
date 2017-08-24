<?php

namespace frontend\modules\home\components;
use common\models\Category;
use frontend\modules\home\models\SearchForm;
use yii\base\Widget;
use Yii;

class SearchRightWidgets extends Widget {

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        $model = new SearchForm();
        $model->category_id = isset(Yii::$app->params['category_id']) ? Yii::$app->params['category_id'] : 0;
        $category = Category::findOne($model->category_id);
        $activeBan = '';
        $activeThue = '';

        if ($category){
            $parent = $category->getParentTop();
            if ($parent == Category::BATDONGSAN_BAN){
                $activeBan = 'active';
            }else{
                $activeThue = 'active';
            }
        }else{
            $activeBan = 'active';
        }
        $model->huyen_id = isset(Yii::$app->params['district_id']) ? Yii::$app->params['district_id'] : 0 ;
        $model->tinh_id = isset(Yii::$app->params['province_id']) ? Yii::$app->params['province_id'] : 0 ;
        return $this->render('search_right',['model'=>$model,'activeBan'=>$activeBan,'activeThue'=>$activeThue]);
    }

}
?>

