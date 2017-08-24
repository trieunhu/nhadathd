<?php
namespace frontend\modules\home\components\page;

use yii\base\Widget;
use frontend\modules\home\models\SearchForm;

class SearchHomeWidgets extends Widget{
    public function init(){
            // add your logic here
            parent::init();
    }
    public function run(){
        $model = new SearchForm();
        return $this->render('search_home',['model'=>$model]);
    }
}
?>

