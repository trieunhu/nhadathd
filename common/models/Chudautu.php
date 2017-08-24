<?php

namespace common\models;

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
 * @property integer $diadiem_id
 * @property string $slug
 */
class Chudautu extends \yii\db\ActiveRecord {

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
    public static function tableName() {
        return 'chudautu';
    }

    function getDia_diem() {
        return $this->hasOne(\common\models\Diadiem::className(), ['id' => 'diadiem_id']);
    }

    function getImage() {
        return $this->hasOne(Images::className(), ['id' => 'table_id'])->viaTable("post_relationships", ['post_id' => 'id'], function ($query) {
                    $query->where(['table_name' => 'images', 'post_table' => Chudautu::tableName()]);
                });
    }

    function getFbimage() {
        return $this->hasOne(Images::className(), ['id' => 'table_id'])->viaTable("post_relationships", ['post_id' => 'id'], function ($query) {
                    $query->where(['table_name' => 'fbimages', 'post_table' => Chudautu::tableName()]);
                });
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

}
