<?php

namespace frontend\modules\home\models;

use common\models\District;
use common\models\Ward;
use Yii;
use common\models\Category;
use yii\helpers\ArrayHelper;
use common\models\Trangthai;
use common\models\Province;
/**
 * This is the model class for table "config".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 */
class SearchForm extends \yii\db\ActiveRecord {

    public $category_id;
    public $category_parent;
    public $tinh_id;
    public $huyen_id;
    public $xa_id;
    public $gia_id;
    public $dien_tich;
    public $huong_id;
    public $title;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['category_id','category_parent','tinh_id','huyen_id','gia_id','xa_id','dien_tich'], 'integer']
        ];
    }
    public static function getListTinh(){
        return ArrayHelper::map(Province::find()->all(), "provinceid", "name");
    }
    public function getListDistrict(){
        if ($this->tinh_id == 0){
            return [];
        }else{
            return ArrayHelper::map(District::find()->where(['provinceid'=>$this->tinh_id])->all(), "districtid", "name");
        }
    }
    public function getListWard(){
        if ($this->huyen_id == 0){
            return [];
        }else{
            return ArrayHelper::map(Ward::find()->where(['districtid'=>$this->huyen_id])->all(), "districtid", "name");
        }
    }
    public static function getListDienTich(){
        return ArrayHelper::map(Trangthai::find()->where(['type' => Trangthai::TYPE_DIENTICH_DAT])->all(), "id", "ten");
    }
    public static function getListGia(){
        return ArrayHelper::map(Trangthai::find()->where(['type' => Trangthai::TYPE_GIA_DAT])->all(), "id", "ten");
    }
    public static function getListHuong(){
        return ArrayHelper::map(Trangthai::find()->where(['type' => 'huong'])->all(), "id", "ten");
    }
    public static function getListCategories(){
        $categories = Category::find()->where(['type'=>Category::TYPE_BDS])->all();
        return ArrayHelper::map($categories,'id','title');
    }
    public static function getCategories($id ) {
        $options = [];
        $child_options = [];
        $model = Category::findOne($id);
        $parents = $model->childs;
        foreach($parents as $ids => $p) {
            $options[$p->id] = "- ".$p->title;
            $children = Category::find()->where("parent_id=:parent_id", [":parent_id"=>$p->id])->all();
            foreach($children as $child) {
                $options[$child->id] = "+ ".$child->title;
                $child_options[$child->id] = ['class'=>'item-child'];
            }
        }
        return [$options,$child_options];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'category_id'=>'Loại bất động sản',
            'tinh_id'=>'Tỉnh/Thành Phố',
            'huyen_id'=>'Quận/Huyện',
            'xa_id'=>'Xã/Phường',
            'dien_tich'=>'Diện tích',
            'huong_id'=>'Hướng nhà',
            'gia_id'=>'Mức giá',
            'title'=>'Nhập địa điểm, vd: The Manor'
        ];
    }

}
