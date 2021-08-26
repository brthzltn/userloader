<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\LoadedUsers;

/**
 * LoadedUsersSearch represents the model behind the search form of `common\models\LoadedUsers`.
 */
class LoadedUsersSearch extends LoadedUsers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'age'], 'integer'],
            [['name', 'city', 'country', 'email', 'salt', 'password', 'picture'], 'safe'],
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
        $query = LoadedUsers::find();

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
            'age' => $this->age,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'salt', $this->salt])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'picture', $this->picture]);

        return $dataProvider;
    }
}
