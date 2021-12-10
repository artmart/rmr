<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "payment_parts".
 *
 * @property int $id
 * @property int $payment_id
 * @property string $part_type
 * @property string|null $label
 * @property float $original_amount
 * @property float $refunded_amount
 * @property float $amount
 * @property int $line_nid
 *
 * @property Payments $payment
 */
class PaymentParts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_parts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_id', 'part_type', 'line_nid'], 'required'],
            [['payment_id', 'line_nid'], 'integer'],
            [['original_amount', 'refunded_amount', 'amount'], 'number'],
            [['part_type'], 'string', 'max' => 10],
            [['label'], 'string', 'max' => 255],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Payments::className(), 'targetAttribute' => ['payment_id' => 'payment_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_id' => 'Payment ID',
            'part_type' => 'Part Type',
            'label' => 'Label',
            'original_amount' => 'Original Amount',
            'refunded_amount' => 'Refunded Amount',
            'amount' => 'Amount',
            'line_nid' => 'Line Nid',
        ];
    }

    /**
     * Gets query for [[Payment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(Payments::className(), ['payment_id' => 'payment_id']);
    }
}
