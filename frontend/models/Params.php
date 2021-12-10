<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "params".
 *
 * @property int $id
 * @property int $user_id
 * @property string $url
 * @property string $key
 * @property string $secret
 * @property string|null $scope
 *
 * @property Accounts[] $accounts
 * @property Bookings[] $bookings
 * @property EventTypes[] $eventTypes
 * @property Extras[] $extras
 * @property Leads[] $leads
 * @property Packages[] $packages
 * @property User $user
 * @property Payments[] $payments
 * @property UnitTypes[] $unitTypes
 * @property Units[] $units
 */
class Params extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'params';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'url', 'key', 'secret'], 'required'],
            [['user_id'], 'integer'],
            [['url', 'key', 'secret'], 'string', 'max' => 255],
            [['scope'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'url' => 'Url',
            'key' => 'Key',
            'secret' => 'Secret',
            'scope' => 'Scope',
        ];
    }

    /**
     * Gets query for [[Accounts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Accounts::className(), ['param_id' => 'id']);
    }

    /**
     * Gets query for [[Bookings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Bookings::className(), ['param_id' => 'id']);
    }

    /**
     * Gets query for [[EventTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventTypes()
    {
        return $this->hasMany(EventTypes::className(), ['param_id' => 'id']);
    }

    /**
     * Gets query for [[Extras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExtras()
    {
        return $this->hasMany(Extras::className(), ['param_id' => 'id']);
    }

    /**
     * Gets query for [[Leads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLeads()
    {
        return $this->hasMany(Leads::className(), ['param_id' => 'id']);
    }

    /**
     * Gets query for [[Packages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPackages()
    {
        return $this->hasMany(Packages::className(), ['param_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Payments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::className(), ['param_id' => 'id']);
    }

    /**
     * Gets query for [[UnitTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnitTypes()
    {
        return $this->hasMany(UnitTypes::className(), ['param_id' => 'id']);
    }

    /**
     * Gets query for [[Units]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasMany(Units::className(), ['param_id' => 'id']);
    }
}
