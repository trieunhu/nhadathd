<?php

namespace frontend\models;
use common\models\Posts;
use common\models\Batdongsan;
use common\models\Slug;
use yii\helpers\Url;
use yii\helpers\Html;
/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $value
 * @property string $table_name
 * @property string $type
 * @property integer $menu_order
 */
class Menu extends \common\models\Menu {

    public $json_value, $select_menu, $header_menu, $footer_menu, $sidebar_menu;

    function getChilds() {
        return $this->hasMany(Menu::className(), ['parent_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'menu';
    }

    public function setTypeMenu($type) {
        $model = Menu::findOne(['type' => $type]);
        if ($model && $model->id != $this->id) {
            $model->type = '';
            $model->save(FALSE);
        }
        $this->type = $type;
        $this->save(FALSE);
    }

    public function checkLinkChild() {
        $menu = $this;
        $slug = \Yii::$app->request->get('slug');
        $linkCurrent = '/' . $slug;
        $slugModel = Slug::findOne(['value'=>$slug]);
        $model = null;
        if ($slugModel ){
            if ($slugModel->table_name == Batdongsan::tableName()){
                $model = Batdongsan::findOne($slugModel->table_id);
            }
            if ($slugModel->table_name == Posts::tableName()){
                $model = Posts::findOne($slugModel->table_id);
            }
        }else{
            if (strpos('/'.$slug,$menu->getLink()) === 0){
                return TRUE;
            }
        }
        if ($model) {
            $category = $model->getCategoriesMenu();
            if ($category && $menu->category && $category->id == $menu->category->id) {
                $menu = $category->menu;
                $linkCurrent = '/' . $category->getSlug();
            }
        }
        if ($menu->getLink() == $linkCurrent) {
            return TRUE;
        }
        foreach ($menu->childs as $value) {
            if ($value->getLink() == $linkCurrent) {
                return TRUE;
            }
            foreach ($value->childs as $key) {
                if ($key->getLink() == $linkCurrent) {
                    return TRUE;
                }
            }
        }
        return FALSE;
    }

    public function getAtiveMenu() {
        $link = $this->getLink();
        $linkCurrent = Url::current();
        if ($this->checkLinkChild()) {
            return TRUE;
        }
        if ($link != '') {
            if ($link === '/') {
                return '/home/default/index' == $linkCurrent;
            }
            return $link == $linkCurrent;
        }
        return FALSE;
    }
     public function getCategoryMenu()
    {
        $categories = $this->childs;
        $category_tree = [];

        if (!empty($categories)) {
            foreach ($categories as $n => $category) {
                $category_r = array(
                    'label' => Html::encode($category->name),
                    'url' => $category->getLink(),
                );
                $category_tree[$n] = $category_r;
                $children = $category->childs;
                if ($children){
                    $arrs = self::getChildren($children);
                    $category_tree[$n]['items'] = $arrs;
                    if (self::getParentsActive($arrs)){
                        $category_tree[$n]['active'] = true;
                    }
                }

            }
        }

        return $category_tree;
    }

    /**
     * @param $children
     * @return array
     */
    public static function getChildren($children)
    {
        $result = array();

        foreach($children as $i => $child) {
            $active = $child->getAtiveMenu();
            $category_r = array(
                'label' => Html::encode($child->name),
                'url' => $child->getLink(),
                'active' => $active,
            );
            $result[$i] = $category_r;
            $newChildren = $child->childs;
//            $newChildren[count($child->childs)] = $child;
            if ($newChildren){
                $arrs = self::getChildren($newChildren);
                $result[$i]['items'] = $arrs;
                if (self::getParentsActive($arrs)){
                    $result[$i]['active'] = true;
                }
            }
        }

        return $result;
    }
    public static function getParentsActive($arrs){
        if (isset($arrs['items'])){
            foreach ($arrs['items'] as $i => $arr) {
                if ($arr['active'] == true){
                    return true;
                }

            }
        }
        return false;
    }
    public function getMenu() {
        $slug = "/".\Yii::$app->request->get('slug');
        $array = $this->getCategoryMenu();
        $arrayChange = [];
        foreach ($array as $i => $value){
            $_url = $value['url'];
            if (strpos($slug,$_url) !== false){

                if ($_url == $slug ){
                    $value['active'] = true;
                }else{
                    $_arrs = explode("$_url-",$slug);
                    if (count($_arrs) > 1){
                        $s1 = $_arrs[1];
                        $modelS = Slug::findOne(['value'=>$s1]);
                        if ($modelS){
                            $value['active'] = true;
                        }
                    }
                }
            }
            if (isset($value['items'])){
                foreach ($value['items'] as $j => $item) {
                    if (isset($item['items'])){
                        foreach ($item['items'] as $k => $ks) {
                            if ($ks['active'] == true){
                                $value['items'][$j]['active'] = true;
                            }
                        }
                    }
                }
            }
            $arrayChange[] = $value;
        }
        $arrs = [
            'items'=>  $arrayChange,
            'activateParents'=>true,
            'options' => ['class' => 'nav navbar-nav', 'id' => "main-menu"]
        ];
        return $arrs;
    }

}
