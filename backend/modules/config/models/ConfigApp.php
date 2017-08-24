<?php

namespace backend\modules\config\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 */
class ConfigApp extends \common\models\Config
{
    public $baseUrl;
    public $nameApp;
    public $content_footer;
    public $tinh_id, $huyen_id, $xa_id;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['baseUrl',  'nameApp','tinh_id','huyen_id','xa_id'], 'string', 'max' => 255],
            [['content_footer'],'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'baseUrl' => 'Đường dẫn web',
            'nameApp' => 'Tên hệ thống',
        ];
    }
}
