<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\NotificationItems;

class NotificationItemsSearch extends NotificationItems
{
    public function rules()
    {
        return [
            [['id', 'user_id', 'notification_id', 'status'], 'integer'],
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
        $query = NotificationItems::find()->orderBy(['status' => SORT_ASC, 'notifications.created_at' => SORT_DESC ]);

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

        $query->joinWith(['notification']);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'notification_items.user_id' => $this->user_id,
            'notification_id' => $this->notification_id,
            'notification_items.status' => $this->status,
        ]);

        return $dataProvider;
    }
}
