<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "associate".
 *
 * @property integer $table_id
 * @property integer $category_id
 * @property string $table_name
 * @property integer $views
 */
class Associate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'associate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['table_id', 'category_id', 'views'], 'integer'],
            [['table_name'], 'string', 'max' => 20],
        ];
    }
    function getProvince() {
        return $this->hasOne(Province::className(), ['provinceid' => 'table_id']);
    }
    function getWard() {
        return $this->hasOne(Ward::className(), ['wardid' => 'table_id']);
    }
    function getDistrict() {
        return $this->hasOne(District::className(), ['districtid' => 'table_id']);
    }
    function getCategory() {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
    public static function create($category_id,$table_id,$table_name){
        $model = self::findOne([
            'table_id'=>$table_id,
            'table_name'=>$table_name,
            'category_id'=>$category_id
        ]);
        if (!$model){
            $model = new self();
            $model->category_id = $category_id;
            $model->table_id = $table_id;
            $model->table_name = $table_name;
            $model->views = 1;
        }else{
            $model->views += 1;
        }
        $model->save();
    }
    function getLink(){
        if ($this->category){
            if ($this->table_name == Province::tableName()){
                return $this->province  ? $this->province->getLink($this->category) : '';
            }
            if ($this->table_name == District::tableName()){
                return $this->district  ? $this->district->getLink($this->category) : '';
            }
            if ($this->table_name == Ward::tableName()){
                return $this->ward  ? $this->ward->getLink($this->category) : '';
            }
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'table_id' => Yii::t('app', 'Table ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'table_name' => Yii::t('app', 'Table Name'),
            'views' => Yii::t('app', 'Views'),
        ];
    }
}
