<?php

namespace app\models\filters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\tables\Tasks;

/**
 * TasksSearch represents the model behind the search form of `app\models\tables\Tasks`.
 */
class TasksSearch extends Tasks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'owner_id', 'responsible_id'], 'integer'],
            [['title', 'status', 'date', 'date_start', 'date_end', 'description'], 'safe'],
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
        $query = Tasks::find();

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
            'owner_id' => $this->owner_id,
            'responsible_id' => $this->responsible_id,
            'date' => $this->date,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
