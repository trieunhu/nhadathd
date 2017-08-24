<?php

namespace common\models;
use yii\helpers\Html;
use Yii;

class BaseAddress extends BaseDB
{
    function getTitle(){
        return $this->type. ' '.$this->name;
    }
    function getLink($category){
        $title = $category->getTitle('none').' tại ';
        $slug = $category->getSlug();
        $title .= $this->name;
        $slug .= '-'.$this->getSlug();
        return "<h3>".Html::a($title,['/home/category/post','slug'=>$slug])."</h3>";
    }
}
