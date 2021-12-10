<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="well col-xs-10 col-sm-8 col-md-6 col-xs-offset-1 col-sm-offset-2 col-md-offset-3">
<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList(['10' => 'Active', '9' =>'Inactive'] /*, ['prompt'=>'- Select -']*/); ?>
    <?= $form->field($model, 'user_group')->dropDownList(['1' => 'Administrator', '2' => 'User'] /*, ['prompt'=>'- Select -']*/); ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
</div>