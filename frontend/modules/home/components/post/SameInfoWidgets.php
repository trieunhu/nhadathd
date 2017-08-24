<?php

namespace frontend\modules\home\components\post;
use yii\base\Widget;
class SameInfoWidgets extends Widget {
    public $title;
    public $model;
    public $type;
    public $category;
    public $limit = 8;

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        $this->type = $this->model->tableName();
        $_view = 'same_info';
        $link = '#';
        if ($this->category){
            $link = $this->category->getLink();
        }
        if ($this->type == \common\models\Posts::tableName()) {
            $posts = $this->category->getPosts()->andWhere('id != :id',[':id'=> $this->model->id])->limit($this->limit)->all();
        }else if ($this->category){
            $posts = $this->category->getBds()->andWhere('id != :id',[':id'=> $this->model->id])->limit($this->limit)->all();
            $_view = 'same_info_bds';
        }
        return $this->render($_view,['title'=>  $this->title,'type'=>  $this->type,'posts'=>$posts,'link'=>$link]);
    }

}
?>

