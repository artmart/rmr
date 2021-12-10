<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "bookings".
 *
 * @property int $booking_id
 * @property int $param_id
 * @property int $id
 * @property int|null $created
 * @property string|null $created_iso
 * @property int|null $changed
 * @property string|null $changed_iso
 * @property string|null $status
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $customer
 * @property string|null $staff
 * @property string|null $rep
 * @property string|null $vehicle
 * @property string|null $assets
 * @property string|null $packages
 * @property string|null $extras
 * @property string|null $event_name
 * @property string|null $event
 * @property string|null $venue
 * @property string|null $price
 * @property string|null $notes
 * @property string|null $signature_required
 * @property string|null $signature
 * @property string|null $travel
 * @property string|null $template
 * @property string|null $taxjar
 * @property string|null $ein
 * @property string|null $tax_rate
 *
 * @property BookingCustomers[] $bookingCustomers
 * @property Params $param
 */
class Bookings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bookings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['param_id', 'id'], 'required'],
            [['param_id', 'id', 'created', 'changed'], 'integer'],
            [['customer', 'staff', 'rep', 'vehicle', 'assets', 'packages', 'extras', 'event_name', 'event', 'venue', 'price', 'notes', 'travel', 'template', 'taxjar', 'ein', 'tax_rate'], 'string'],
            [['created_iso', 'changed_iso', 'phone'], 'string', 'max' => 20],
            [['status'], 'string', 'max' => 30],
            [['email', 'signature'], 'string', 'max' => 100],
            [['signature_required'], 'string', 'max' => 7],
            [['param_id'], 'exist', 'skipOnError' => true, 'targetClass' => Params::className(), 'targetAttribute' => ['param_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'booking_id' => 'Booking ID',
            'param_id' => 'Param ID',
            'id' => 'ID',
            'created' => 'Created',
            'created_iso' => 'Created Iso',
            'changed' => 'Changed',
            'changed_iso' => 'Changed Iso',
            'status' => 'Status',
            'email' => 'Email',
            'phone' => 'Phone',
            'customer' => 'Customer',
            'staff' => 'Staff',
            'rep' => 'Rep',
            'vehicle' => 'Vehicle',
            'assets' => 'Assets',
            'packages' => 'Packages',
            'extras' => 'Extras',
            'event_name' => 'Event Name',
            'event' => 'Event',
            'venue' => 'Venue',
            'price' => 'Price',
            'notes' => 'Notes',
            'signature_required' => 'Signature Required',
            'signature' => 'Signature',
            'travel' => 'Travel',
            'template' => 'Template',
            'taxjar' => 'Taxjar',
            'ein' => 'Ein',
            'tax_rate' => 'Tax Rate',
        ];
    }

    /**
     * Gets query for [[BookingCustomers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookingCustomers()
    {
        return $this->hasMany(BookingCustomers::className(), ['booking_id' => 'id']);
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
