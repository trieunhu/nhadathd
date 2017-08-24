<?php

namespace frontend\modules\home\components;

use common\models\Batdongsan;
use yii\base\Widget;
use common\models\Category;
use yii\data\Pagination;

class TinRaoVatMoiNhatWidgets extends Widget {

    public $select_order;
    public $title = 'TIN RAO MỚI NHẤT';
    public $models;
    public $pagination;
    public $select;
    public $limitList = 6;

    public function init() {
        // add your logic here
        parent::init();
    }

    public function run() {
        $models = $this->models;
        $categoryBan = NULL;$categoryThue = NULL;
        $paginationThue = null;
        if (count($models) == 0 && $this->select_order != 'select') {
            $categoryBan = Category::findOne(14);
            $arridChilds = $categoryBan->getIdChilds();
            $query = Batdongsan::find()->innerJoin('post_relationships p', 'p.post_id = id')->where(['p.table_id' => $arridChilds, 'p.table_name' => 'category']);
            $this->pagination = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => $this->limitList]);
            $models = $query->offset($this->pagination->offset)->limit($this->limitList)->all();
            $categoryThue = Category::findOne(15);
            $queryThue = Batdongsan::find()->innerJoin('post_relationships p', 'p.post_id = id')->where(['p.table_id' => $categoryThue->getIdChilds(), 'p.table_name' => 'category']);
            $paginationThue = new Pagination(['totalCount' => $queryThue->count(), 'defaultPageSize' => $this->limitList]);
        }
        return $this->render('tinraomoinhat', ['select' => $this->select,
                    'models' => $models, 'pagination' => $this->pagination,
                    'select_order' => $this->select_order, 'title' => $this->title,
                    'categoryBan'=>$categoryBan,'categoryThue'=>$categoryThue,
                    'paginationThue'=>$paginationThue
                ]);
    }

}

