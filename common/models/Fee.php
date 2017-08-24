<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fee".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property integer $fee
 * @property integer $sale
 * @property integer $vat
 * @property string $class_view
 */
class Fee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'price', 'fee', 'sale', 'vat', 'class_view'], 'required'],
            [['description'], 'string'],
            [['price', 'fee', 'sale', 'vat'], 'integer'],
            [['name', 'class_view'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'fee' => Yii::t('app', 'Fee'),
            'sale' => Yii::t('app', 'Sale'),
            'vat' => Yii::t('app', 'Vat'),
            'class_view' => Yii::t('app', 'Class View'),
        ];
    }
}
