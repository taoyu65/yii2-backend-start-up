<?php

namespace common\searches;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AdministratorLoginHistory;

/**
 * AdministratorLoginHistorySearch represents the model behind the search form of `common\models\AdministratorLoginHistory`.
 */
class AdministratorLoginHistorySearch extends AdministratorLoginHistory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'administrator_id', 'login_time'], 'integer'],
            [['login_ip'], 'safe'],
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
        $query = AdministratorLoginHistory::find();

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
            'administrator_id' => $this->administrator_id,
            'login_time' => $this->login_time,
        ]);

        $query->andFilterWhere(['like', 'login_ip', $this->login_ip]);

        return $dataProvider;
    }
}
