<?php

namespace frontend\modules\home\controllers;

use common\models\Associate;
use common\models\Category;
use common\models\District;
use common\models\Province;
use common\models\Trangthai;
use common\models\Ward;
use Yii;
use yii\data\Pagination;
use frontend\modules\home\models\SearchForm;
use yii\helpers\Html;
use yii\web\Controller;
use common\models\Batdongsan;
use common\models\Posts;
use common\models\Tags;
use common\models\Diadiem;
use yii\helpers\ArrayHelper;
use common\models\Slug;
class CategoryController extends Controller {

    public $limit = 6;
    public $limitList = 6;
    public function actionSearch(){
        if (isset($_POST['search'])){
            $search = new SearchForm();
            $slug = '';
            if ($search->load(Yii::$app->request->post())) {
                $category = Category::findOne($search->category_id);
                if ($category){
                    $slug = $category->getSlug();
                }
                $posts = Batdongsan::find()->select(['id','huong_id','dien_tich','( gia * dien_tich ) as tong_gia'])->distinct();
                if ($search->tinh_id != null){
                    $slugDiadiem = '';
                    $diadiemQuery = Diadiem::find()->where(['tinh_id'=>Html::encode($search->tinh_id)]);
                    $tinh = Province::findOne(['provinceid'=>$search->tinh_id]);
                    if ($tinh){
                        $slugDiadiem = $tinh->getSlug();
                    }
                    if ($search->huyen_id != null){
                        $diadiemQuery->andWhere(['huyen_id'=>$search->huyen_id]);
                        $district = District::findOne($search->huyen_id);
                        if ($district){
                            $slugDiadiem = $district->getSlug();
                        }
                        if ($search->xa_id != null){
                            $ward = Ward::findOne($search->xa_id);
                            if ($ward){
                                $slugDiadiem = $ward->getSlug();
                            }
                            $diadiemQuery->andWhere(['xa_id'=>$search->xa_id]);
                        }

                    }
                    if (empty($slug)){
                        $categoryParent = Category::findOne($search->category_parent);
                        if ($categoryParent){
                            $slug = $categoryParent->getSlug();
                        }
                    }
                    $slug = $slug.'-'.$slugDiadiem;
                    $diadiemQuery->select('id');
                    $array =  $diadiemQuery->asArray()->all();
                    $idDiadiem = ArrayHelper::getColumn($array,'id');
                    if (count($idDiadiem) > 0) {
                        $posts = $posts->andWhere(['diadiem_id' => $idDiadiem]);
                    }
                }
                $dien_tich = Trangthai::findOne($search->dien_tich);
                if($dien_tich){
                    if ($dien_tich->value_max != 0 || $dien_tich->value_min != 0){
                        $posts = $posts->andWhere($dien_tich->value_min.'<= dien_tich ');
                        $posts = $posts->andWhere(' dien_tich <= '.$dien_tich->value_max);
                    }else{
                        $posts = $posts->andWhere('dien_tich >= 0');
                    }
                }
                $gia = Trangthai::findOne($search->gia_id);
                if ($gia){
                    if ($gia->value_min != 0 || $gia->value_max != 0){
                        $posts = $posts->andHaving('tong_gia >='.$gia->value_min);
                        $posts = $posts->andHaving('tong_gia <= '.$gia->value_max);
                    }else{
                        $posts = $posts->having(['tong_gia'=>0]);
                    }
                }
                if (!empty($search->huong_id)){
                    $posts = $posts->andWhere(['huong_id'=>$search->huong_id]);
                }
                if (empty($slug)){
                    $categoryParent = Category::findOne($search->category_parent);
                    if ($categoryParent){
                        $slug = $categoryParent->getSlug();
                    }
                }
//                die($posts->createCommand()->sql);
                $postIds = ArrayHelper::getColumn($posts->asArray()->all(),'id');
                Yii::$app->session->set("postIds",$postIds);
                $this->redirect(['post','slug'=>$slug]);
            }
        }
    }
    function getData($model,$view,$posts = [],$key ='id',$category = null){
        $select = new \frontend\modules\home\models\SelectTinrao();

        if (\Yii::$app->session->get("select_tinrao") != NULL) {
            $select->select_id = \Yii::$app->session->get("select_tinrao");
        }
        if ($select->load(\Yii::$app->request->post())) {
            \Yii::$app->session->set("select_tinrao", $select->select_id);
        }
        $query = Batdongsan::find();
        if (count($posts) > 0){
            Yii::$app->session->set("postIds",[]);
        }
        if ($model && $model->tableName() == Category::tableName() && !$category) {
//            die('sao vao day');
            $category = $model;
        }
        if ($category){
            $arrId = $category->getIdChilds();
//            die(var_dump($arrId));
            $query = $query->innerJoin('post_relationships p', 'p.post_id = id')->where(['p.table_id' => $arrId, 'p.table_name' => 'category']);
        }
        if ($select->select_id == 1) {
            $query = $query->orderBy(['ngay_tao' => SORT_DESC]);
        }
        if ($select->select_id == 2) {
            $query = $query->orderBy(['gia' => SORT_ASC]);
        }
        if ($select->select_id == 3) {
            $query = $query->orderBy(['gia' => SORT_DESC]);
        }
        if ($select->select_id == 4) {
            $query = $query->orderBy(['dien_tich' => SORT_ASC]);
        }
        if ($select->select_id == 5) {
            $query = $query->orderBy(['dien_tich' => SORT_DESC]);
        }
        if (count($posts) > 0){
            $query = $query->andWhere([$key=>$posts]);
        }
        $count = $query->count();
//        die('count '.$count.var_dump($posts));
        $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => $this->limitList]);
        $articles = $query->offset($pagination->offset)->limit($this->limitList)->all();
        return $this->render($view, [
                'count' => $count,
                'pagination' => $pagination,
                'models' => $articles,
                'model' => $model,
                'select' => $select
            ]
        );
    }
    public function actionPost($slug ='') {
        $this->layout = "@app/views/layouts/main_slidebar_search";

        $modelS = Slug::findOne(['value'=>$slug]);
        $category = null;
        if (!$modelS){
            $categoryName = Category::find()->where(['type'=>Batdongsan::tableName()])->all();
            foreach ($categoryName as $item) {
                $s  = $item->getSlug();
                if (strpos($slug,$s) === 0){
                    $s1 = explode("$s-",$slug)[1];
                    $modelS = Slug::findOne(['value'=>$s1]);
                    $category = $item;
                    if ($modelS) break;
                }
            }
        }
        if (!$modelS){
            throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
        }
        if ($modelS->table_name == Category::tableName()) {
            $model = Category::findOne($modelS->table_id);
            $model->getSeoPost(true);
            if ($model->type == Posts::tableName()) {
                $menu = $model->menu;
                $parent = $menu;
                $isParent = 1;
                $countChild = 0;
                if ($menu){
                    if ($menu->parent && $menu->parent->name != "Main") {
                        $parent = $menu->parent;
                        $isParent = 0;
                    }
                    $countChild = count($parent->childs) + 1;
                }
                if ($countChild > 4 && $isParent == 1) {
                    return $this->render('post_5_child', ['parent' => $parent, 'model' => $model, 'count' => $countChild]);
                } else if ($countChild > 1 && $countChild < 5 && $isParent == 1) {
                    return $this->render('post_4_child', ['parent' => $menu, 'model' => $model]);
                } else if($countChild > 0) {
                    $p = $model->getPosts()->limit($this->limit)->all();
                    $aid = [];
                    foreach ($p as $value) {
                        $aid[]= $value->id;
                    }
                    $posts = $model->getPosts()->where(['NOT IN','id',$aid])->offset($this->limit);
                    $count = $posts->count();
                    $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => $this->limitList]);
                    $posts = $posts->offset($pagination->offset)->limit($this->limitList)->all();
                    return $this->render('post_0_child', ['parent' => $parent,'pagination' => $pagination ,'model' => $model, 'posts' => $posts,'p'=>$p]);
                }else{
                    return $this->goHome();
                }
            } else {
                Yii::$app->params['category_id'] = $model->id;
                $postIds = Yii::$app->session->get('postIds');
                return $this->getData($model,'index',$postIds);
            }
        }
        if ($modelS->table_name == Batdongsan::tableName()){
            $model = Batdongsan::findOne($modelS->table_id);
            if ($model) {

                $model->getSeoPost(TRUE);
                $category = $model->getCategoriesbds()->one();

                return $this->render('details',['model'=>$model,'category'=>$category]);
            }
        }
        if ($modelS->table_name == Posts::tableName()){
            $model = Posts::findOne($modelS->table_id);
            if ($model && $model->type == Posts::TYPE_PAGE) {
                $this->layout = "@app/views/layouts/main_member";
                return $this->render('details_page',['model'=>$model]);

            }else if ($model && $model->type == Posts::TYPE_POST) {
                $category = $model->getCategoriesMenu();
                if ($category){
                    $menu = $category->menu;
                    $parent = $menu;
                    if ($menu && $menu->parent && $menu->parent->name != "Main") {
                        $parent = $menu->parent;
                    }
                    $model->getSeoPost(TRUE);
                    $tag= $model->getTags()->one();
                    $postsTag = [];
                    if ($tag){
                        $postsTag = $tag->getPosts()->andWhere('id != :id',[':id'=>$model->id])->limit(3)->all();
                    }
                    return $this->render('details_post',['model'=>$model,'parent'=>$parent,'category'=>$category,'tag'=>$tag,'postsTag'=>$postsTag]);
                }else{
                    return $this->goHome();
                }
            }
        }
        if ($modelS->table_name == Tags::tableName()){
            $model = Tags::findOne($modelS->table_id);
            if ($model){
                $model->getSeoPost(TRUE);
                $posts = $model->getPosts()->offset($this->limit);
                $count = $posts->count();
                $pagination = new Pagination(['totalCount' => $count, 'defaultPageSize' => $this->limitList]);
                $posts = $posts->offset($pagination->offset)->limit($this->limitList)->all();
                return $this->render('post_tag_list', ['pagination' => $pagination ,'model' => $model, 'posts' => $posts]);
            }else{
                throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
            }
        }
        if ($modelS->table_name == Province::tableName() || $modelS->table_name == District::tableName() || $modelS->table_name == Ward::tableName()){
            $diadiemQuery = Diadiem::find();
            $model = null;
            if ($modelS->table_name == Province::tableName()){

                $model = Province::findOne($modelS->table_id);
                $diadiemQuery = $diadiemQuery->andWhere('tinh_id='.$modelS->table_id);
                Yii::$app->params['province_id'] = $modelS->table_id;
            }
            if ($modelS->table_name == District::tableName()){
                $model = District::findOne($modelS->table_id);
                $diadiemQuery->andWhere(['huyen_id'=>$modelS->table_id]);
                Yii::$app->params['district_id'] = $modelS->table_id;
                if ($model && $model->province){
                    Yii::$app->params['province_id'] = $model->province->id;
                    $diadiemQuery->andWhere('tinh_id='.$model->province->id);
                }
            }
            if ($modelS->table_name == Ward::tableName()){
                $model = Ward::findOne($modelS->table_id);
                $diadiemQuery->andWhere('xa_id='.$modelS->table_id);
                if ($model){
                    $district = $model->district;
                    if ($district){
                        Yii::$app->params['district_id'] = $district->districtid;
                        $diadiemQuery->andWhere('huyen_id='.$district->districtid);
                        if ($district->province){
                            Yii::$app->params['province_id'] = $district->province->id;
                            $diadiemQuery->andWhere('tinh_id='.$district->province->id);
                        }
                    }
                }
            }
            if ($category){
                Yii::$app->params['category_id'] = $category->id;
                Associate::create($category->id,$modelS->table_id,$modelS->table_name);
            }

            $diadiemQuery->select('id');
            $array =  $diadiemQuery->asArray()->all();
            $idDiadiem = ArrayHelper::getColumn($array,'id');

            if ($category){
                $category->getSeoPost(true);
            }
            return $this->getData($model,'index',$idDiadiem,'diadiem_id',$category);
        }
    }

}
