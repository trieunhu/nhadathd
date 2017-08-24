<?php

namespace backend\modules\posts\models;

use Yii;

/**
 * This is the model class for table "post_relationships".
 *
 * @property integer $post_id
 * @property integer $table_id
 * @property string $table_name
 */
class PostRelationships extends \common\models\PostRelationships
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_relationships';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'table_id', 'table_name'], 'required'],
            [['post_id', 'table_id'], 'integer'],
            [['table_name'], 'string', 'max' => 20]
        ];
    }
//    PostRelationships::setPost($category->id, $model->id, "category");
//    PostRelationships::setPost($fbImage->id, $model->id, "fbimages", Batdongsan::tableName());

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'table_id' => 'Table ID',
            'table_name' => 'Table Name',
        ];
    }
}
