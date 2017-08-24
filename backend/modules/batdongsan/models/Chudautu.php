<?php

namespace backend\modules\batdongsan\models;
use backend\modules\posts\models\Images;
use backend\modules\posts\models\PostRelationships;
use backend\modules\posts\models\Taxonomy;
use Yii;

/**
 * This is the model class for table "chudautu".
 *
 * @property integer $id
 * @property string $ten
 * @property string $mo_ta
 * @property string $dien_thoai
 * @property string $website
 * @property string $email
 */
class Chudautu extends \common\models\Chudautu
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chudautu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten', 'mo_ta', 'dien_thoai', 'website', 'email'], 'required'],
            [['id','fb_image'], 'integer'],
            [['mo_ta','xa_id', 'tinh_id', 'huyen_id', 'seo_title', 'seo_description', 'seo_keyword', 'fb_title', 'fb_description', 'diadiem'], 'string'],
            [['ten', 'dien_thoai', 'website', 'email'], 'string', 'max' => 255]
        ];
    }

    function getSeoPost() {
        $taxonomy = Taxonomy::findOne(['table_name' => Chudautu::tableName(), 'type' => \common\func\StaticDefine::$SEO_BAI_VIET, 'table_id' => $this->id]);
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
        PostRelationships::deleteAll(['post_id' => $this->id, 'post_table' => Chudautu::tableName()]);
        Taxonomy::deleteAll(['table_name' => Batdongsan::tableName(), 'table_id' => $this->id]);
        if ($this->dia_diem) {
            $this->dia_diem->delete();
        }
        $this->delete();
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten' => 'Tên',
            'mo_ta' => 'Mô tả',
            'dien_thoai' => 'Điện thoại',
            'website' => 'Website',
            'email' => 'Email',
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
