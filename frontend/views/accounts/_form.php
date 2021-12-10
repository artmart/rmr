<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Accounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'param_id')->textInput() ?>

    <?= $form->field($model, 'result')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'business_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'business_website')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'business_timezone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'business_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'business_postcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'business_country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'business_admin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency_sign')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'affiliate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_paid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
