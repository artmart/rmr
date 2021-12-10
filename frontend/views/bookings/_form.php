<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bookings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bookings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'param_id')->textInput() ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'created_iso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'changed')->textInput() ?>

    <?= $form->field($model, 'changed_iso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'staff')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rep')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'vehicle')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'assets')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'packages')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'extras')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'event_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'event')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'venue')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'signature_required')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'signature')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'travel')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'template')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'taxjar')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ein')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tax_rate')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
