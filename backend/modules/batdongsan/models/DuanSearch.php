<?php

namespace backend\modules\batdongsan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\batdongsan\models\Duan;

/**
 * DuanSearch represents the model behind the search form about `backend\modules\batdongsan\models\Duan`.
 */
class DuanSearch extends Duan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'chudautu_id', 'diadiem_id', 'status'], 'integer'],
            [['ten', 'mo_ta', 'dien_tich', 'ngay_tao', 'slug'], 'safe'],
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
    public function search($params)
    {
        $query = Duan::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'chudautu_id' => $this->chudautu_id,
            'diadiem_id' => $this->diadiem_id,
            'ngay_tao' => $this->ngay_tao,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'ten', $this->ten])
            ->andFilterWhere(['like', 'mo_ta', $this->mo_ta])
            ->andFilterWhere(['like', 'dien_tich', $this->dien_tich])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
