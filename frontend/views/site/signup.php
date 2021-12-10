<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Signup';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="well col-xs-10 col-sm-8 col-md-6 col-xs-offset-1 col-sm-offset-2 col-md-offset-3">
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'firstname')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'lastname')->textInput(/*['autofocus' => true]*/) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'phone_number')->textInput() ?>
                <?= $form->field($model, 'password')->passwordInput() ?>            
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-4">{image}</div><div class="col-lg-8">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                <div class="row">
                <div class="col-lg-9">
                 <?= $form->field($model, 'agree_to_terms')->checkBox(['label' => 'Agree to Terms</a> ','data-size'=>'small', 'uncheckValue' => '']); //<a href="https://www.brucegreigmediator.com/dispute-calculator-terms" target="_blank">  ?>
                 </div>
                 <div class="col-lg-3">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                 </div>
                </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>


