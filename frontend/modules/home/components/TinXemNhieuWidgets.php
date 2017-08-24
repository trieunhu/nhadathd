<?php
namespace frontend\modules\home\components;
use common\models\Category;
use yii\base\Widget;

class TinXemNhieuWidgets extends Widget{
    public $div_ngoai;
    public function init(){
            // add your logic here
            parent::init();
    }
    public function run(){
        $categoryXemnhieu = Category::findOne(2);
        if ($categoryXemnhieu) {
            $postXemnhieu = $categoryXemnhieu->getPosts()->limit(5)->all();
            return $this->render('tin_xem_nhieu',
                    [
                        'categoryXemnhieu'=>$categoryXemnhieu,'postXemnhieu'=>$postXemnhieu,'div_ngoai'=>  $this->div_ngoai
                    ]);
        }
        
    }
}
?>

