<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\FormulaMaster;

/**
 * FormulaMasterSearch represents the model behind the search form of `backend\models\FormulaMaster`.
 */
class FormulaMasterSearch extends FormulaMaster
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'receiver_name'], 'integer'],
            [[ 'receiver_per'], 'number'],
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
        $query = FormulaMaster::find();

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
            'category_id' => $this->category_id,
            'receiver_name' => $this->receiver_name,
           // 'deduction_per' => $this->deduction_per,
            'receiver_per' => $this->receiver_per,
        ]);

        return $dataProvider;
    }
}
