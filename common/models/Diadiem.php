<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "diadiem".
 *
 * @property integer $id
 * @property string $xa_id
 * @property string $huyen_id
 * @property string $tinh_id
 * @property string $ten
 * @property string $positionX
 * @property string $positionY
 */
class Diadiem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'diadiem';
    }
    function getXa() {
        return $this->hasOne(Ward::className(), ['wardid' => 'xa_id']);
    }
    function getDistrict() {
        return $this->hasOne(District::className(), ['districtid' => 'huyen_id']);
    }
    function getProvince() {
        return $this->hasOne(Province::className(), ['provinceid' => 'tinh_id']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['xa_id', 'huyen_id', 'tinh_id', 'ten'], 'string', 'max' => 255]
        ];
    }
    public static function createPostion($tinh,$huyen,$xa,$title = '',$positionX,$positionY){
        $model = new self();
        $model->tinh_id = $tinh ? $tinh : 0;
        $model->huyen_id = $huyen ? $huyen : 0;
        $model->xa_id = $xa ? $xa : 0;
        $model->ten = $title;
        $model->positionX = $positionX;
        $model->positionY = $positionY;

        $model->save(false);
        return $model;
    }
    public static function create($tinh,$huyen,$xa,$title = ''){
        $model = self::findOne([
            'tinh_id'=>$tinh,
            'huyen_id'=>$huyen,
            'xa_id'=>$xa
        ]);
        if (!$model){
            $model = new self();
            $model->tinh_id = $tinh;
            $model->huyen_id = $huyen;
            $model->xa_id = $xa;
            $model->ten = $title;
            $model->save();
        }
        return $model;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'xa_id' => 'Xa ID',
            'huyen_id' => 'Huyen ID',
            'tinh_id' => 'Tinh ID',
            'ten' => 'Ten',
        ];
    }
}
