<?php

namespace frontend\modules\home\components;

use yii\base\Widget;

class OneCategoryWidgets extends Widget {

    public $category;
    public $className;
    public $posts;
    public $limit = 6;
    public $linkImage = true;
    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        
        if ($this->category) {
            if (count($this->posts) == 0) {
                $this->posts = $this->category->getPosts()->limit($this->limit)->all();
            }
            if ($this->className == 'equalheight3') {
                return $this->render('one_category_2_col',['className'=>  $this->className,'category'=>  $this->category,'posts'=>  $this->posts,'linkImage'=>  $this->linkImage]);
            }  else {
                return $this->render('one_category',['className'=>  $this->className,'category'=>  $this->category,'posts'=>  $this->posts,'linkImage'=>  $this->linkImage]);
            }
            
        }
    }

}
?>

