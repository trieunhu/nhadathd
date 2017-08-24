<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $title
 * @property string $file
 * @property string $description
 * @property string $alt
 * @property string $url
 * @property integer $status
 * @property string $create_at
 * @property string $update_at
 */
class Images extends \yii\db\ActiveRecord
{
    const STATUS_TEMP = -1;
    const STATUS_ACTIVE = 0;
    const STATUS_MEMBER = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'title'], 'required'],
            [['id', 'author_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['create_at', 'update_at'], 'safe'],
            [['title', 'alt', 'url'], 'string', 'max' => 255]
        ];
    }
    public function Xoa() {
        if ($this->details) {
            $json = json_decode($this->details->value);
            $path = $json->path . $json->imagename;
            $pathThumbnail200 = $json->path.$json->thumbnail200;
            if (file_exists($pathThumbnail200)) {
                unlink($pathThumbnail200);
            }
            if (file_exists($path)) {
                unlink($path);
            }
            $this->details->delete();
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
            'author_id' => 'Author ID',
            'title' => 'Title',
            'description' => 'Description',
            'alt' => 'Alt',
            'url' => 'Url',
            'status' => 'Status',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }
    public function getDetails() {
        return $this->hasOne(Taxonomy::className(), ['table_id' => 'id'])->where(['table_name' => 'images', 'type' => \common\func\StaticDefine::$CHI_TIET_HINH_ANH]);
    }
    public function getUrl($size = 0) {
        $link = "";
        $config = Config::findOne(["name" => "baseUrl"]);
        if ($config) {
            $baseUrl = $config->value.'uploads/';
            if ($size == 0) {
                $link = $baseUrl . $this->url.$this->file;
            } else if($size >  0) {
                if ($this->details) {
                    $json = json_decode($this->details->value);
                    if ($json->thumbnail200 && $size == 200) {
                        $link = $baseUrl.$json->url.$json->thumbnail200;
                    }
                    if (isset($json->thumbnail150) && $json->thumbnail150 && $size == 150) {
                        $link = $baseUrl.$json->url.$json->thumbnail150;
                    }
                }
            }
        }
        return $link;
    }
}
