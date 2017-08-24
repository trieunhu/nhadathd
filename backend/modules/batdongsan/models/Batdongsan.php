<?php

namespace backend\modules\batdongsan\models;

use Yii;
use backend\modules\posts\models\Taxonomy;
use backend\modules\posts\models\Images;
use backend\modules\posts\models\Category;
use backend\modules\posts\models\Tags;
use backend\modules\posts\models\PostRelationships;

class Batdongsan extends \common\models\Batdongsan
{
    const GIA_TRI_GIA_THOA_THUAN = 15;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'batdongsan';
    }


    public function Xoa()
    {
        PostRelationships::deleteAll(['post_id' => $this->id, 'post_table' => Batdongsan::tableName()]);
        Taxonomy::deleteAll(['table_name' => Batdongsan::tableName(), 'table_id' => $this->id]);
        if ($this->dia_diem) {
            $this->dia_diem->delete();
        }
        $this->delete();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->donvi_id == self::GIA_TRI_GIA_THOA_THUAN){
                $this->gia = 0;
            }

            return true;
        } else {
            return false;
        }
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten', 'gia', 'dien_tich', 'donvi_id', 'mat_tien', 'tinh_id', 'huyen_id'], 'required'],
            [['mo_ta', 'xa_id', 'slug', 'tinh_id', 'slug', 'huyen_id', 'seo_title', 'seo_description', 'seo_keyword', 'fb_title', 'fb_description', 'diadiem'], 'string'],
            [['user_id', 'status', 'huong_id', 'donvi_id', 'hopdong_id', 'diadiem_id'], 'integer'],
            [['ngay_tao', 'ngay_hien_thi', 'ngay_het_han'], 'safe'],
            [['ten', 'gia', 'dien_tich', 'mat_tien', 'duong_truoc_nha'], 'string', 'max' => 255]
        ];
    }

    public function checkTinhFormat($attribute, $params)
    {
        // no real check at the moment to be sure that the error is triggered
        $this->addError($attribute, "lỗi");
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
            'gia' => 'Giá',
            'dien_tich' => 'Diện tích',
            'mat_tien' => 'Mặt tiền',
            'duong_truoc_nha' => 'Đường trước nhà',
            'user_id' => 'User ID',
            'huong_id' => 'Hướng',
            'donvi_id'=>'Đơn vị',
            'diadiem_id' => 'Địa điểm',
            'ngay_tao' => 'Ngay Tao',
            'ngay_hien_thi' => 'Ngay Hien Thi',
            'ngay_het_han' => 'Ngay Het Han',
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
