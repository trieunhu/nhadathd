<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "duan".
 *
 * @property integer $id
 * @property string $ten
 * @property string $mo_ta
 * @property string $dien_tich
 * @property integer $user_id
 * @property integer $chudautu_id
 * @property integer $diadiem_id
 * @property string $ngay_tao
 * @property string $slug
 * @property integer $status
 */
class Duan extends \yii\db\ActiveRecord
{
     public $seo_title;
    public $seo_description;
    public $seo_keyword;
    public $fb_title;
    public $fb_description;
    public $fb_image;
    public $tinh_id, $huyen_id, $xa_id, $diadiem;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'duan';
    }
       function getDia_diem() {
        return $this->hasOne(\common\models\Diadiem::className(), ['id' => 'diadiem_id']);
    }

    function getAuthor() {
        return $this->hasOne(\common\models\User::className(), ['id' => 'author_id']);
    }

    function getCategories() {
        return $this->hasMany(Category::className(), ['id' => 'table_id'])->viaTable("post_relationships", ['post_id' => 'id'], function ($query) {
                    $query->where(['table_name' => 'category', 'post_table' => Duan::tableName()]);
                });
    }

    function getTags() {
        return $this->hasMany(Tags::className(), ['id' => 'table_id'])->viaTable("post_relationships", ['post_id' => 'id'], function ($query) {
                    $query->where(['table_name' => 'tags', 'post_table' => Duan::tableName()]);
                });
    }

    function getImage() {
        return $this->hasOne(Images::className(), ['id' => 'table_id'])->viaTable("post_relationships", ['post_id' => 'id'], function ($query) {
                    $query->where(['table_name' => 'images', 'post_table' => Duan::tableName()]);
                });
    }

    function getFbimage() {
        return $this->hasOne(Images::className(), ['id' => 'table_id'])->viaTable("post_relationships", ['post_id' => 'id'], function ($query) {
                    $query->where(['table_name' => 'fbimages', 'post_table' => Duan::tableName()]);
                });
    }

    function getSeoPost() {
        $taxonomy = Taxonomy::findOne(['table_name' => Duan::tableName(), 'type' => \common\func\StaticDefine::$SEO_BAI_VIET, 'table_id' => $this->id]);
        if ($taxonomy) {
            $json[] = json_decode($taxonomy->value);
            $this->seo_title = $json[0]->seo_title;
            $this->seo_description = $json[0]->seo_description;
            $this->seo_keyword = $json[0]->seo_keyword;
            $this->fb_description = $json[0]->fb_description;
            $this->fb_title = $json[0]->fb_title;
            if ($this->fbimage) {
                $this->fb_image = $this->fbimage->id;
            }
        }
    }


    function getStringTags() {
        $s = "";
        $i = 0;
        if ($this->tags != NULL) {
            foreach ($this->tags as $value) {
                if ($i == count($this->tags) - 1) {
                    $s .= $value->title;
                } else {
                    $s .= $value->title . ',';
                }
                $i++;
            }
        }
        return $s;
    }
    public function Xoa() {
        PostRelationships::deleteAll(['post_id' => $this->id, 'post_table' => Duan::tableName()]);
        Taxonomy::deleteAll(['table_name' => Batdongsan::tableName(), 'table_id' => $this->id]);
        if ($this->dia_diem) {
            $this->dia_diem->delete();
        }
        $this->delete();
    }
    public function getTitle($the = '') {

        if ($the != '') {
            $link = "<a href='" . $this->getLink() . "'><$the>$this->ten</$the></a>";
        }  else {
            $link = "<a href='" . $this->getLink() . "'>$this->ten</a>";
        }
        return $link;
    }

    public function getLink() {
        $link = "#";
        return $link;
    }
    public function getMota() {
        $this->getSeoPost();
        $link = "<p>$this->seo_description</p>";
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
        $src = '';
        if ($this->image) {
            $src = $this->image->url;
        }
        return $src;
    }

    function getGia() {
        $src = $this->gia;
        if ($this->donvi) {
            $src .= ' ' . $this->donvi->ten;
            ;
        }
        return $src;
    }

    function getTextDiaDiem() {
        $src = '';
        if ($this->dia_diem) {
            if ($this->dia_diem->xa->district) {
                $src .=  $this->dia_diem->xa->district->type . " " . $this->dia_diem->xa->district->name;
                if ($this->dia_diem->xa->district->province) {
                    $src .= ' - ' . $this->dia_diem->xa->district->province->name;
                }
            }
        }
        return $src;
    }

    function getTime() {
        return \common\func\FunctionCommon::time_fomat($this->ngay_tao);
    }

}
