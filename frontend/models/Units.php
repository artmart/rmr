<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "units".
 *
 * @property int $unit_id
 * @property int $id
 * @property int $param_id
 * @property string|null $label
 *
 * @property Params $param
 */
class Units extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'units';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'param_id'], 'required'],
            [['id', 'param_id'], 'integer'],
            [['label'], 'string', 'max' => 255],
            [['param_id'], 'exist', 'skipOnError' => true, 'targetClass' => Params::className(), 'targetAttribute' => ['param_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'unit_id' => 'Unit ID',
            'id' => 'ID',
            'param_id' => 'Param ID',
            'label' => 'Label',
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
