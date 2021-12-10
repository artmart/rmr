<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "accounts".
 *
 * @property int $id
 * @property int $param_id
 * @property string|null $result
 * @property string|null $business_name
 * @property string|null $business_website
 * @property string|null $business_timezone
 * @property string|null $business_address
 * @property string|null $business_postcode
 * @property string|null $business_country
 * @property string|null $business_admin
 * @property string|null $currency_code
 * @property string|null $currency_sign
 * @property string|null $affiliate
 * @property string|null $is_paid
 * @property string|null $plan
 *
 * @property Params $param
 */
class Accounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['param_id'], 'required'],
            [['param_id'], 'integer'],
            [['result', 'is_paid', 'plan'], 'string', 'max' => 10],
            [['business_name', 'business_website', 'business_address', 'affiliate'], 'string', 'max' => 255],
            [['business_timezone', 'business_country', 'business_admin'], 'string', 'max' => 100],
            [['business_postcode'], 'string', 'max' => 20],
            [['currency_code'], 'string', 'max' => 5],
            [['currency_sign'], 'string', 'max' => 2],
            [['param_id'], 'exist', 'skipOnError' => true, 'targetClass' => Params::className(), 'targetAttribute' => ['param_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'param_id' => 'Param ID',
            'result' => 'Result',
            'business_name' => 'Business Name',
            'business_website' => 'Business Website',
            'business_timezone' => 'Business Timezone',
            'business_address' => 'Business Address',
            'business_postcode' => 'Business Postcode',
            'business_country' => 'Business Country',
            'business_admin' => 'Business Admin',
            'currency_code' => 'Currency Code',
            'currency_sign' => 'Currency Sign',
            'affiliate' => 'Affiliate',
            'is_paid' => 'Is Paid',
            'plan' => 'Plan',
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
