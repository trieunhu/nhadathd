<?php

namespace backend\modules\batdongsan\models;

use Yii;
use backend\modules\posts\models\Taxonomy;
use backend\modules\posts\models\Images;
use backend\modules\posts\models\Category;
use backend\modules\posts\models\Tags;
use backend\modules\posts\models\PostRelationships;

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
class Duan extends \common\models\Duan {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'duan';
    }

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
    public function rules() {
        return [
            [[ 'ten', 'mo_ta',  'chudautu_id'], 'required'],
            [['id','fb_image', 'user_id', 'chudautu_id', 'diadiem_id', 'status'], 'integer'],
            [['mo_ta','xa_id', 'tinh_id', 'huyen_id', 'seo_title', 'seo_description', 'seo_keyword', 'fb_title', 'fb_description', 'diadiem'], 'string'],
            [['ngay_tao'], 'safe'],
            [['ten', 'dien_tich', 'slug'], 'string', 'max' => 255]
        ];
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

    public function Xoa() {
        PostRelationships::deleteAll(['post_id' => $this->id, 'post_table' => Duan::tableName()]);
        Taxonomy::deleteAll(['table_name' => Batdongsan::tableName(), 'table_id' => $this->id]);
        if ($this->dia_diem) {
            $this->dia_diem->delete();
        }
        $this->delete();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'ten' => 'Ten',
            'mo_ta' => 'Mo Ta',
            'dien_tich' => 'Dien Tich',
            'user_id' => 'User ID',
            'chudautu_id' => 'Chudautu ID',
            'diadiem_id' => 'Diadiem ID',
            'ngay_tao' => 'Ngay Tao',
            'slug' => 'Slug',
            'status' => 'Status',
            'seo_title' => "Seo Title",
            'seo_description' => "Seo Description",
            'seo_keyword' => "Keyword",
            'fb_title' => "Facebook Title",
            'fb_description' => 'FaceBook Description',
            'fb_image' => 'Ảnh FaceBook',
            'tinh_id' => "Tỉnh",
            'xa_id' => "Xã",
            'huyen_id' => 'Huyện',
        ];
    }

}
