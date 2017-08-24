<?php

namespace frontend\modules\home\components;

use yii\base\Widget;

class ListTitleCategoryWidgets extends Widget {
    public $model;
    public $parent;
    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        return $this->render('list_category',['model'=>  $this->model,'parent'=>  $this->parent]);
    }

}
?>

