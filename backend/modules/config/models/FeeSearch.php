<?php

namespace backend\modules\config\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Fee;

/**
 * FeeSearch represents the model behind the search form about `common\models\Fee`.
 */
class FeeSearch extends Fee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'price', 'fee', 'sale', 'vat'], 'integer'],
            [['name', 'description', 'class_view'], 'safe'],
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
        $query = Fee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'fee' => $this->fee,
            'sale' => $this->sale,
            'vat' => $this->vat,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'class_view', $this->class_view]);

        return $dataProvider;
    }
}
