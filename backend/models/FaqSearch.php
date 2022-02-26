<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Faq;

/**
 * FaqSearch represents the model behind the search form of `backend\models\Faq`.
 */
class FaqSearch extends Faq
{
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['question','user_id', 'answer'], 'safe'],
        ];
    }

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
        $query = Faq::find();

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
        $query->joinWith(['user']);
        // grid filtering conditions
        $query->andFilterWhere([
            'faq.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'question', $this->question])
            ->andFilterWhere(['like', 'user.full_name', $this->user_id])
            ->andFilterWhere(['like', 'answer', $this->answer]);

        return $dataProvider;
    }
}
