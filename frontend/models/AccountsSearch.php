<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Accounts;

/**
 * AccountsSearch represents the model behind the search form of `frontend\models\Accounts`.
 */
class AccountsSearch extends Accounts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'param_id'], 'integer'],
            [['result', 'business_name', 'business_website', 'business_timezone', 'business_address', 'business_postcode', 'business_country', 'business_admin', 'currency_code', 'currency_sign', 'affiliate', 'is_paid', 'plan'], 'safe'],
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
        $query = Accounts::find();

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
            'param_id' => $this->param_id,
        ]);

        $query->andFilterWhere(['like', 'result', $this->result])
            ->andFilterWhere(['like', 'business_name', $this->business_name])
            ->andFilterWhere(['like', 'business_website', $this->business_website])
            ->andFilterWhere(['like', 'business_timezone', $this->business_timezone])
            ->andFilterWhere(['like', 'business_address', $this->business_address])
            ->andFilterWhere(['like', 'business_postcode', $this->business_postcode])
            ->andFilterWhere(['like', 'business_country', $this->business_country])
            ->andFilterWhere(['like', 'business_admin', $this->business_admin])
            ->andFilterWhere(['like', 'currency_code', $this->currency_code])
            ->andFilterWhere(['like', 'currency_sign', $this->currency_sign])
            ->andFilterWhere(['like', 'affiliate', $this->affiliate])
            ->andFilterWhere(['like', 'is_paid', $this->is_paid])
            ->andFilterWhere(['like', 'plan', $this->plan]);

        return $dataProvider;
    }
}
