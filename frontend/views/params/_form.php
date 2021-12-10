<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="params-form">
<div class="well well-lg">
<div class="row">
<div class="col-lg-12">
    <?php $form = ActiveForm::begin(); ?>
    
    <?php // $form->field($model, 'user_id')->textInput() 
    if($model->isNewRecord){$user_id = Yii::$app->user->id;}else{$user_id = $model->user_id;}
    echo $form->field($model, 'user_id')->hiddenInput(['value'=>$user_id])->label(false); 
    ?>

    <?php // $form->field($model, 'user_id')->textInput() ?>
<div class="form-group col-lg-10">
    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
</div>
<div class="form-group col-lg-2">
    <?php // $form->field($model, 'scope')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'scope')->dropDownList(['full'=>'full', 'null'=>'null', 'minimal'=>'minimal']) ?>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="form-group col-lg-5">
    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>
</div>
<div class="form-group col-lg-5">
    <?= $form->field($model, 'secret')->textInput(['maxlength' => true]) ?>
</div>

<div class="form-group col-lg-2">
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'style' => 'margin-top: 24px; width: 100%;',]) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>
</div>
</div>
</div>
</div>
