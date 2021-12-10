<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ApisSearchForm extends Model
{
    public $key;
    public $secret;
    public $scope;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'secret'], 'required'], 
            [['key', 'secret',], 'string', 'max' => 255],   
            [['scope'], 'string', 'max' => 10],       
        ];
    }
}