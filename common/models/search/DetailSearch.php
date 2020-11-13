<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\entity\detail;

/**
 * DetailSearch represents the model behind the search form about `common\models\entity\detail`.
 */
class DetailSearch extends detail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pesan_id', 'costumer_id', 'costumer_address', 'product_id', 'pesan_total', 'pesan_paid', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['date', 'status'], 'safe'],
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
        $query = detail::find();

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
            'pesan_id' => $this->pesan_id,
            'costumer_id' => $this->costumer_id,
            'costumer_address' => $this->costumer_address,
            'product_id' => $this->product_id,
            'pesan_total' => $this->pesan_total,
            'pesan_paid' => $this->pesan_paid,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
