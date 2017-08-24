<?php

namespace backend\modules\batdongsan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\batdongsan\models\Batdongsan;

/**
 * BatdongsanSearch represents the model behind the search form about `backend\modules\batdongsan\models\Batdongsan`.
 */
class BatdongsanSearch extends Batdongsan
{
    public $category_id;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'huong_id','category_id'], 'integer'],
            [['ten', 'mo_ta', 'gia', 'dien_tich', 'mat_tien', 'duong_truoc_nha', 'diadiem_id', 'ngay_tao', 'ngay_hien_thi', 'ngay_het_han'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params,$filer)
    {
        $this->load($params);
        $query = Batdongsan::find();
        if ($filer != 0){
            $query = $query->where(['status'=>$filer]);
        }
        if ($this->category_id > 0) {
            $query->innerJoin('post_relationships','post_relationships.post_id = id')->where(['post_relationships.post_table'=>  Batdongsan::tableName(),'post_relationships.table_id'=>  $this->category_id,'post_relationships.table_name'=>'category']);
        }  
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'huong_id' => $this->huong_id,
            'ngay_tao' => $this->ngay_tao,
            'ngay_hien_thi' => $this->ngay_hien_thi,
            'ngay_het_han' => $this->ngay_het_han,
        ]);

        $query->andFilterWhere(['like', 'ten', $this->ten])
            ->andFilterWhere(['like', 'mo_ta', $this->mo_ta])
            ->andFilterWhere(['like', 'gia', $this->gia])
            ->andFilterWhere(['like', 'dien_tich', $this->dien_tich])
            ->andFilterWhere(['like', 'mat_tien', $this->mat_tien])
            ->andFilterWhere(['like', 'duong_truoc_nha', $this->duong_truoc_nha])
            ->andFilterWhere(['like', 'diadiem_id', $this->diadiem_id]);

        return $dataProvider;
    }
}
