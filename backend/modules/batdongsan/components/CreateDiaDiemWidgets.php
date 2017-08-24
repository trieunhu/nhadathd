<?php
namespace backend\modules\batdongsan\components;

use yii\base\Widget;

class CreateDiaDiemWidgets extends Widget{
    public $form;
    public $model;
    public function init(){
            // add your logic here
            parent::init();
    }
    public function run(){
        return $this->render('create_diadiem',['form'=>  $this->form,'model'=>  $this->model]);
    }
}
?>

