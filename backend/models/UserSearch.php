<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

class UserSearch extends User
{
    public function rules()
    {
        return [
            [['id', 'status', 'chat_id'], 'integer'],
            [['username','role', 'full_name', 'phone', 'email'], 'safe'],
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
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if($this->role){
            $query = User::find()
                ->select('user.*')
                ->leftJoin('auth_assignment', "auth_assignment.user_id = user.id")
                ->andWhere(['auth_assignment.item_name'=>$this->role]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'chat_id' => $this->chat_id,
        ]);

        $query->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['or', ['like','user.full_name', $this->username], ['like', 'user.username', $this->username]])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
