<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\entity\Kuesoner;
use common\models\entity\Kuesoner2;

/**
 * KuesonerAdminSearch represents the model behind the search form of `common\models\entity\Kuesoner`.
 */
class KuesonerAdminSearch extends Kuesoner2
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'jenis_kelamin', 'usia', 'kedudukan_dalam_keluarga', 'status_pernikahan', 'pendidikan_terakhir', 'pekerjaan', 'penghasilan_perbulan', ], 'integer'],
            [['province_id', 'district_id', 'kecamatan', 'kelurahan', 'tgl_respon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Kuesoner2::find();

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
            'user_id' => $this->user_id,
            'tgl_respon' => $this->tgl_respon,
            'jenis_kelamin' => $this->jenis_kelamin,
            'usia' => $this->usia,
            'kedudukan_dalam_keluarga' => $this->kedudukan_dalam_keluarga,
            'status_pernikahan' => $this->status_pernikahan,
            'pendidikan_terakhir' => $this->pendidikan_terakhir,
            'pekerjaan' => $this->pekerjaan,
            'penghasilan_perbulan' => $this->penghasilan_perbulan,
           
        ]);

        $query->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'kecamatan', $this->kecamatan])
            ->andFilterWhere(['like', 'kelurahan', $this->kelurahan]);

        return $dataProvider;
    }
}
