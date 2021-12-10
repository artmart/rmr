<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "leads".
 *
 * @property int $lead_id
 * @property int $param_id
 * @property int $id
 * @property int|null $created
 * @property string|null $created_iso
 * @property int|null $changed
 * @property string|null $changed_iso
 * @property string|null $customer
 * @property string|null $status
 * @property string|null $activity
 * @property string|null $event
 * @property string|null $converted_bookings
 *
 * @property Params $param
 */
class Leads extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'leads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['param_id', 'id'], 'required'],
            [['param_id', 'id', 'created', 'changed'], 'integer'],
            [['customer', 'activity', 'event', 'converted_bookings'], 'string'],
            [['created_iso', 'changed_iso'], 'string', 'max' => 20],
            [['status'], 'string', 'max' => 30],
            [['param_id'], 'exist', 'skipOnError' => true, 'targetClass' => Params::className(), 'targetAttribute' => ['param_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lead_id' => 'Lead ID',
            'param_id' => 'Param ID',
            'id' => 'ID',
            'created' => 'Created',
            'created_iso' => 'Created Iso',
            'changed' => 'Changed',
            'changed_iso' => 'Changed Iso',
            'customer' => 'Customer',
            'status' => 'Status',
            'activity' => 'Activity',
            'event' => 'Event',
            'converted_bookings' => 'Converted Bookings',
        ];
    }

    /**
     * Gets query for [[Param]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParam()
    {
        return $this->hasOne(Params::className(), ['id' => 'param_id']);
    }
}
