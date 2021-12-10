<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Payments;

/**
 * PaymentsSearch represents the model behind the search form of `frontend\models\Payments`.
 */
class PaymentsSearch extends Payments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_id', 'param_id', 'transaction_id', 'created', 'booking_id'], 'integer'],
            [['id', 'label', 'parts', 'created_iso', 'source', 'submitter'], 'safe'],
            [['original_amount', 'refunded_amount', 'amount', 'gratuity'], 'number'],
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
        $query = Payments::find();

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
            'payment_id' => $this->payment_id,
            'param_id' => $this->param_id,
            'transaction_id' => $this->transaction_id,
            'created' => $this->created,
            'original_amount' => $this->original_amount,
            'refunded_amount' => $this->refunded_amount,
            'amount' => $this->amount,
            'gratuity' => $this->gratuity,
            'booking_id' => $this->booking_id,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'parts', $this->parts])
            //->andFilterWhere(['like', 'created_iso', $this->created_iso])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'submitter', $this->submitter]);
            
        if(isset ($this->created_iso)&&$this->created_iso!=''){ //you dont need the if function if yourse sure you have a not null date
              $date_explode=explode(" - ",$this->created_iso);
              $date1=strtotime(trim($date_explode[0]));
              $date2=strtotime(trim($date_explode[1]));
              $query->andFilterWhere(['between','created_iso',date('Y-m-d',$date1),date('Y-m-d',$date2)]);
            }

        return $dataProvider;
    }
}
