<?php

namespace common\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "province".
 *
 * @property string $provinceid
 * @property string $name
 * @property string $type
 */
class Province extends BaseAddress
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'province';
    }
    function getDistricts() {
        return $this->hasMany(District::className(), ['provinceid' => 'provinceid']);
    }
    function getId(){
        return $this->provinceid;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provinceid', 'name', 'type'], 'required'],
            [['provinceid'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 100],
            [['type'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'provinceid' => 'Provinceid',
            'name' => 'Name',
            'type' => 'Type',
        ];
    }
}
