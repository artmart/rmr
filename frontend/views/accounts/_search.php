<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AccountsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'param_id') ?>

    <?= $form->field($model, 'result') ?>

    <?= $form->field($model, 'business_name') ?>

    <?= $form->field($model, 'business_website') ?>

    <?php // echo $form->field($model, 'business_timezone') ?>

    <?php // echo $form->field($model, 'business_address') ?>

    <?php // echo $form->field($model, 'business_postcode') ?>

    <?php // echo $form->field($model, 'business_country') ?>

    <?php // echo $form->field($model, 'business_admin') ?>

    <?php // echo $form->field($model, 'currency_code') ?>

    <?php // echo $form->field($model, 'currency_sign') ?>

    <?php // echo $form->field($model, 'affiliate') ?>

    <?php // echo $form->field($model, 'is_paid') ?>

    <?php // echo $form->field($model, 'plan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
