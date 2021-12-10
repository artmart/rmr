<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $payment_id
 * @property int $param_id
 * @property string $id
 * @property int|null $transaction_id
 * @property string|null $label
 * @property string|null $parts
 * @property int|null $created
 * @property string|null $created_iso
 * @property float|null $original_amount
 * @property float|null $refunded_amount
 * @property float|null $amount
 * @property float|null $gratuity
 * @property int|null $booking_id
 * @property string|null $source
 * @property string|null $submitter
 *
 * @property Params $param
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['param_id', 'id'], 'required'],
            [['param_id', 'transaction_id', 'created', 'booking_id'], 'integer'],
            [['parts', 'source', 'submitter'], 'string'],
            [['original_amount', 'refunded_amount', 'amount', 'gratuity'], 'number'],
            [['id'], 'string', 'max' => 50],
            [['label'], 'string', 'max' => 255],
            [['created_iso'], 'string', 'max' => 20],
            [['param_id'], 'exist', 'skipOnError' => true, 'targetClass' => Params::className(), 'targetAttribute' => ['param_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'payment_id' => 'Payment ID',
            'param_id' => 'Param ID',
            'id' => 'ID',
            'transaction_id' => 'Transaction ID',
            'label' => 'Label',
            'parts' => 'Parts',
            'created' => 'Created',
            'created_iso' => 'Created Iso',
            'original_amount' => 'Original Amount',
            'refunded_amount' => 'Refunded Amount',
            'amount' => 'Amount',
            'gratuity' => 'Gratuity',
            'booking_id' => 'Booking ID',
            'source' => 'Source',
            'submitter' => 'Submitter',
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
