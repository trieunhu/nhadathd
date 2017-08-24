<?php

namespace frontend\modules\home\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 */
class SelectTinrao extends \yii\db\ActiveRecord {

    public $select_id;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['select_id'], 'integer']
        ];
    }

    public function getValueLabel() {
        return [
            0 => 'Thông thường',
            1 => 'Tin mới nhất',
            2 => 'Giá thấp nhất',
            3 => 'Giá cao nhất',
            4 => 'Diện tích nhỏ nhất',
            5 => 'Diện tích lớn nhất',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'baseUrl' => 'Đường dẫn web',
            'nameApp' => 'Tên hệ thống',
        ];
    }

}
