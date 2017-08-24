<?php

namespace common\models;

use common\func\FunctionCommon;
use yii\helpers\Url;
use Yii;

/**
 * This is the model class for table "batdongsan".
 *
 * @property integer $id
 * @property string $ten
 * @property string $mo_ta
 * @property integer $gia
 * @property string $dien_tich
 * @property string $mat_tien
 * @property string $duong_truoc_nha
 * @property integer $user_id
 * @property integer $huong_id
 * @property integer $diadiem_id
 * @property integer $tinh_trang
 * @property integer $loai_id
 * @property integer $views
 * @property string $ngay_tao
 * @property string $ngay_hien_thi
 * @property string $ngay_het_han
 * @property string $slug
 * @property integer $hopdong_id
 * @property integer $donvi_id
 * @property integer $status
 */
class Batdongsan extends BaseDB {

    const STATUS_TRASH = 1;
    const STATUS_DRAFT = 2;
    const STATUS_TEMP = -1;
    const STATUS_ACTIVE = 5;
    public $tinh_id, $huyen_id, $xa_id, $diadiem;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'batdongsan';
    }

    function getDia_diem() {
        return $this->hasOne(\common\models\Diadiem::className(), ['id' => 'diadiem_id']);
    }
    function getFee() {
        return $this->hasOne(Fee::className(), ['id' => 'fee_id']);
    }

    function getAuthor() {
        return $this->hasOne(\common\models\User::className(), ['id' => 'author_id']);
    }
    function getMember() {
        return $this->hasOne(Member::className(), ['id' => 'member_id']);
    }

    function getDonvi() {
        return $this->hasOne(\common\models\Trangthai::className(), ['id' => 'donvi_id'])->onCondition(['type' => 'donvi']);
    }
    function ShowID(){
        return $this->id + 1000;
    }
    function getCategoriesbds() {
        return $this->hasMany(Category::className(), ['id' => 'table_id'])->onCondition(['type' => 'batdongsan'])->viaTable("post_relationships", ['post_id' => 'id'], function ($query) {
                    $query->where(['table_name' => 'category', 'post_table' => Batdongsan::tableName()]);
                });
    }
    function getSliders() {
        return $this->hasMany(Images::className(), ['id' => 'table_id'])->viaTable("post_relationships", ['post_id' => 'id'], function ($query) {
                    $query->where(['table_name' => 'slider', 'post_table' => Batdongsan::tableName()]);
                });
    }
    function getTextDienTich(){
        return $this->dien_tich.' m²';
    }


    public function Xoa() {
        PostRelationships::deleteAll(['post_id' => $this->id, 'post_table' => Batdongsan::tableName()]);
        Taxonomy::deleteAll(['table_name' => Batdongsan::tableName(), 'table_id' => $this->id]);
        if ($this->dia_diem) {
            $this->dia_diem->delete();
        }
        $this->delete();
    }
    public function getDescription() {
        return $this->mo_ta;
    }

    public function getTitle($the = '',$classThe = '',$limit = 0) {
        if ($this->fee){
            $class = $this->fee->class_view;
            $classThe .= ' '.$class;
        }
        $title  = $this->ten;
        if ($limit > 0){
            $title = FunctionCommon::_substr($title,$limit);
        }
        if ($the != '' && $the != 'none') {
            $link = "<a href='" . $this->getLink() . "'><$the  class='$classThe'>$title</$the></a>";
        } elseif($the == 'none') {
            $link = $title;
        }  else {
            $link = "<a href='" . $this->getLink() . "'>$title</a>";
        }
        return $link;
    }

    public function getLink() {
        $link = Url::to(['/home/category/post', 'slug' => $this->getSlug()]);
        return $link;
    }

    function getHinhAnhLink() {
        $img = "<a href='" . $this->getLink() . "' class='img-feature'>" . $this->getHinhAnh() . "</a>";
        return $img;
    }

    function getHinhAnh() {
        $src = $this->getLinkAnh();
        $img = "<img src='$src' alt='' class='img-responsive'>";
        return $img;
    }

    function getLinkAnh() {
        $src = $this->id;
        if ($this->image) {
            $src = $this->image->getUrl();
        }
        return $src;
    }

    function getGia() {
        $src = $this->gia;
        if ($this->donvi) {
            $src .= ' ' . $this->donvi->ten;
        }
        return $src;
    }
    function getHuong(){
        return $this->hasOne(Trangthai::className(),['id'=>'huong_id']);
    }
    public function getLinkDiaDiem() {
        $slug = '';
        if ($this->dia_diem) {
            if ($this->dia_diem->province) {
                $slug = $this->dia_diem->province->getSlug();
            }
            if ($this->dia_diem->district) {
                $slug = $this->dia_diem->district->getSlug();
            }
            if ($this->dia_diem->xa) {
                $slug = $this->dia_diem->xa->getSlug();
            }
        }
        $slug = $this->getCategoriesbds()->one()->getSlug()."-$slug";
        $link = Url::to(['/home/category/post', 'slug' => $slug]);
        return $link;
    }
    function getTextDiaDiem() {
        $src = '';
        if ($this->dia_diem) {
            if ($this->dia_diem->xa && $this->dia_diem->xa->district) {
                $src .= " " . $this->dia_diem->xa->district->name;
                if ($this->dia_diem->xa->district->province) {
                    $src .= ' - ' . $this->dia_diem->xa->district->province->name;
                }
            }
            if ($this->dia_diem->district) {
                $src .= " " . $this->dia_diem->district->name;
                if ($this->dia_diem->district->province) {
                    $src .= ' - ' . $this->dia_diem->district->province->name;
                }
            }
        }
        return $src;
    }
    function getExpiration(){
        return \common\func\FunctionCommon::time_fomat($this->ngay_het_han);
    }
    function getTime() {
        return \common\func\FunctionCommon::time_fomat($this->ngay_tao);
    }

}
