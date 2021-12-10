<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Leads;

/**
 * LeadsSearch represents the model behind the search form of `frontend\models\Leads`.
 */
class LeadsSearch extends Leads
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lead_id', 'param_id', 'id', 'created', 'changed'], 'integer'],
            [['created_iso', 'changed_iso', 'customer', 'status', 'activity', 'event', 'converted_bookings'], 'safe'],
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
        $query = Leads::find();

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
            'lead_id' => $this->lead_id,
            'param_id' => $this->param_id,
            'id' => $this->id,
            'created' => $this->created,
            'changed' => $this->changed,
        ]);

//->andFilterWhere(['like', 'created_iso', $this->created_iso])->andFilterWhere(['like', 'changed_iso', $this->changed_iso])
        $query->andFilterWhere(['like', 'customer', $this->customer])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'activity', $this->activity])
            ->andFilterWhere(['like', 'event', $this->event])
            ->andFilterWhere(['like', 'converted_bookings', $this->converted_bookings]);
            
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
