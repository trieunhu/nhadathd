<?php
namespace backend\modules\config\components;

use backend\modules\posts\models\Posts;
use yii\base\Widget;

class AddMenuWidgets extends Widget{
    public $model;
    public $title;
    public $type;
    public function init(){
            // add your logic here
            parent::init();
    }
    public function run(){
        if ($this->type == 'page'){
            $this->model = Posts::find()->where(['type'=>'page','status'=>Posts::STATUS_ACTIVE])->all();
        }
//        $type 
        return $this->render('addMenu',['data'=>  $this->model,'title'=>  $this->title,'type'=>$this->type]);
    }
}
?>

