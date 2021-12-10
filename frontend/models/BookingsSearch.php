<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Bookings;

/**
 * BookingsSearch represents the model behind the search form of `frontend\models\Bookings`.
 */
class BookingsSearch extends Bookings
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['booking_id', 'param_id', 'id', 'created', 'changed'], 'integer'],
            [['created_iso', 'changed_iso', 'status', 'email', 'phone', 'customer', 'staff', 'rep', 'vehicle', 'assets', 'packages', 'extras', 'event_name', 'event', 'venue', 'price', 'notes', 'signature_required', 'signature', 'travel', 'template', 'taxjar', 'ein', 'tax_rate'], 'safe'],
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
        $query = Bookings::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'booking_id' => $this->booking_id,
            'param_id' => $this->param_id,
            'id' => $this->id,
            'created' => $this->created,
            'changed' => $this->changed,
            'status' => $this->status,            
        ]);

//->andFilterWhere(['like', 'created_iso', $this->created_iso])->andFilterWhere(['like', 'changed_iso', $this->changed_iso])->andFilterWhere(['like', 'status', $this->status])

        $query
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'customer', $this->customer])
            ->andFilterWhere(['like', 'staff', $this->staff])
            ->andFilterWhere(['like', 'rep', $this->rep])
            ->andFilterWhere(['like', 'vehicle', $this->vehicle])
            ->andFilterWhere(['like', 'assets', $this->assets])
            ->andFilterWhere(['like', 'packages', $this->packages])
            ->andFilterWhere(['like', 'extras', $this->extras])
            ->andFilterWhere(['like', 'event_name', $this->event_name])
            ->andFilterWhere(['like', 'event', $this->event])
            ->andFilterWhere(['like', 'venue', $this->venue])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'signature_required', $this->signature_required])
            ->andFilterWhere(['like', 'signature', $this->signature])
            ->andFilterWhere(['like', 'travel', $this->travel])
            ->andFilterWhere(['like', 'template', $this->template])
            ->andFilterWhere(['like', 'taxjar', $this->taxjar])
            ->andFilterWhere(['like', 'ein', $this->ein])
            ->andFilterWhere(['like', 'tax_rate', $this->tax_rate]);
            
        if(isset ($this->created_iso)&&$this->created_iso!=''){ //you dont need the if function if yourse sure you have a not null date
              $date_explode=explode(" - ",$this->created_iso);
              $date1=strtotime(trim($date_explode[0]));
              $date2=strtotime(trim($date_explode[1]));
              $query->andFilterWhere(['between','created_iso',date('Y-m-d',$date1),date('Y-m-d',$date2)]);
            }
        if(isset ($this->changed_iso)&&$this->changed_iso!=''){ //you dont need the if function if yourse sure you have a not null date
              $date_explode=explode(" - ",$this->changed_iso);
              $date1=strtotime(trim($date_explode[0]));
              $date2=strtotime(trim($date_explode[1]));
              $query->andFilterWhere(['between','changed_iso',date('Y-m-d',$date1),date('Y-m-d',$date2)]);
            }

        return $dataProvider;
    }
}
