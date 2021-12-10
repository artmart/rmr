<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "extras".
 *
 * @property int $extra_id
 * @property int $param_id
 * @property int $id
 * @property string|null $label
 * @property float|null $price
 * @property string|null $description
 * @property float|null $upsell_price
 * @property string|null $upsell_description
 * @property string|null $image
 * @property int|null $quantity
 * @property int|null $stock
 * @property string|null $unit_types
 * @property int|null $extras_group
 * @property string|null $disabled
 * @property string|null $custom
 *
 * @property Params $param
 */
class Extras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'extras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['param_id', 'id'], 'required'],
            [['param_id', 'id', 'quantity', 'stock', 'extras_group'], 'integer'],
            [['price', 'upsell_price'], 'number'],
            [['description', 'upsell_description', 'unit_types'], 'string'],
            [['label', 'image'], 'string', 'max' => 255],
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
            'extra_id' => 'Extra ID',
            'param_id' => 'Param ID',
            'id' => 'ID',
            'label' => 'Label',
            'price' => 'Price',
            'description' => 'Description',
            'upsell_price' => 'Upsell Price',
            'upsell_description' => 'Upsell Description',
            'image' => 'Image',
            'quantity' => 'Quantity',
            'stock' => 'Stock',
            'unit_types' => 'Unit Types',
            'extras_group' => 'Extras Group',
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
