<?php

namespace frontend\modules\home\models;

use common\models\District;
use common\models\Transaction;
use common\models\Ward;
use Yii;
use yii\helpers\ArrayHelper;
use common\models\Trangthai;

class BatdongsanForm extends \common\models\Batdongsan {

    public $category_id;
    public $gia_id;
    public $positionX;
    public $positionY;
    public $dia_diem;
    public $display_name;
    public $mobile;
    public $email;
    public $address;
    public function rules()
    {
        return [
            [['ten','tinh_id','huyen_id','dia_diem' ,'mo_ta','category_id', 'gia', 'dien_tich','fee_id','mobile','display_name','email'], 'required'],
            [['status', 'so_tang', 'so_phong', 'so_tolet','huong_id'], 'default', 'value'=> 0],
            [['mobile'], 'match', 'pattern' => '/^(84|0)(1\d{9}|9\d{8})$/'],
            ['email','email'],
            [['mo_ta','positionY','positionX','dia_diem'], 'string'],
            [['gia', 'user_id', 'member_id', 'huong_id','fee_id','category_id', 'views', 'hopdong_id', 'donvi_id', 'status', 'so_tang', 'so_phong', 'so_tolet'], 'integer'],
            [['ngay_tao', 'ngay_hien_thi', 'ngay_het_han'], 'safe'],
            [['ten', 'dien_tich', 'mat_tien', 'duong_truoc_nha', 'slug'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels() {
        return [
            'mat_tien'=>'Mặt tiền',
            'duong_truoc_nha'=>'Đường trước nhà',
            'so_tang'=>'Số tầng',
            'so_phong'=>'Số phòng',
            'so_tolet'=>'Số tolet',
            'category_id'=>'Loại bất động sản',
            'tinh_id'=>'Tỉnh/Thành Phố',
            'huyen_id'=>'Quận/Huyện',
            'xa_id'=>'Xã/Phường',
            'dien_tich'=>'Diện tích',
            'huong_id'=>'Hướng nhà',
            'gia_id'=>'Mức giá',
            'title'=>'Nhập địa điểm, vd: The Manor',
            'diadiem_id'=>'Địa điểm',
            'dia_diem'=>'Địa điểm',
            'ten'=>'Tiêu đề',
            'mo_ta'=>'Nội dung mô tả',
            'fee_id'=>'Loại tin',
            'display_name'=> 'Họ và tên',
            'address'=>'Địa chỉ',
            'mobile'=>'Điện thoại',
            'gia'=>'Giá'
        ];
    }
    public function createTransition($countDay){
        if ($this->fee){
            if ($countDay == 0){
                $countDay = 1;
            }
            $money = (($this->fee->price - $this->fee->sale) * $countDay + $this->fee->fee) * ($this->fee->vat / 100 + 1);
            if ($money > 0){
                return Transaction::create($this->id,$this->member_id,$countDay,$money,Transaction::STATUS_PEDDING);
            }
        }
        return null;
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
    public static function getListDonVi(){
        return ArrayHelper::map(Trangthai::find()->where(['type' => 'donvi'])->all(), "id", "ten");
    }
}
