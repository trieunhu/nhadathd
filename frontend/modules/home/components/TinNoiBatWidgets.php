<?php
namespace frontend\modules\home\components;
use common\models\Category;
use yii\base\Widget;

class TinNoiBatWidgets extends Widget{
    public function init(){
            parent::init();
    }
    public function run(){
        $categoryNoiBat = Category::findOne(1);
        if ($categoryNoiBat) {
            return $this->render('tinnoibat',
                    [
                        'categoryNoiBat'=>$categoryNoiBat,
                    ]);
        }
        
    }
}
?>

