<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property string $districtid
 * @property string $name
 * @property string $type
 * @property string $location
 * @property string $provinceid
 */
class District extends BaseAddress
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district';
    }
    function getWards() {
        return $this->hasMany(Ward::className(), ['districtid' => 'districtid']);
    }
    function getProvince() {
        return $this->hasOne(Province::className(), ['provinceid' => 'provinceid']);
    }
    function getId(){
        return $this->districtid;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['districtid', 'name', 'type', 'location', 'provinceid'], 'required'],
            [['districtid', 'provinceid'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 100],
            [['type', 'location'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'districtid' => 'Districtid',
            'name' => 'Name',
            'type' => 'Type',
            'location' => 'Location',
            'provinceid' => 'Provinceid',
        ];
    }
}
