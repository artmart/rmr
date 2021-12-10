<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "packages".
 *
 * @property int $package_id
 * @property int $param_id
 * @property int $id
 * @property string|null $label
 * @property float|null $price
 * @property string|null $description
 * @property int|null $unit_type
 * @property string|null $time_slot
 * @property string|null $included_extras
 * @property string|null $disabled
 * @property string|null $custom
 *
 * @property Params $param
 */
class Packages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'packages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['param_id', 'id'], 'required'],
            [['param_id', 'id', 'unit_type'], 'integer'],
            [['price'], 'number'],
            [['description', 'included_extras'], 'string'],
            [['label'], 'string', 'max' => 255],
            [['time_slot'], 'string', 'max' => 20],
            [['disabled', 'custom'], 'string', 'max' => 7],
            [['param_id'], 'exist', 'skipOnError' => true, 'targetClass' => Params::className(), 'targetAttribute' => ['param_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'package_id' => 'Package ID',
            'param_id' => 'Param ID',
            'id' => 'ID',
            'label' => 'Label',
            'price' => 'Price',
            'description' => 'Description',
            'unit_type' => 'Unit Type',
            'time_slot' => 'Time Slot',
            'included_extras' => 'Included Extras',
            'disabled' => 'Disabled',
            'custom' => 'Custom',
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
