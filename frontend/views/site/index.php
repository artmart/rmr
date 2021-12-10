<style>
.dataTables_length{
    float: left;
}

.dataTables_filter{
    float: right;
}
</style>

<?php
$this->title = Yii::$app->name;

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use yii\widgets\ActiveForm;

?> 
<div class="site-index">

    <div class="body-content">
<div class="well well-lg">
<div class="row">
    <div class="col-lg-12">
         
    <?php $form = ActiveForm::begin(['id' => 'form_id', 'options' => ['class'=>'form-inline1']]); ?>
    <div class="form-group col-lg-4">
        <?= $form->field($form_model, 'key', ['inputOptions'=>[ 'class'=>'form-control', 'placeholder'=>'Key']])->textInput(['autofocus' => true]) ?>
    </div>
    <div class="form-group col-lg-4">
        <?= $form->field($form_model, 'secret', ['inputOptions'=>[ 'class'=>'form-control', 'placeholder'=>'Secret']]) ?>
    </div>
    <div class="form-group col-lg-2">
        <?= $form->field($form_model, 'scope')->dropDownList(['full'=>'full', 'null'=>'null', 'minimal'=>'minimal']) ?>
    </div>

      <!-- <div id="wait" style="display:none;z-index: 200000;"><img src='/vendor/img/ajaxloader.gif'/>Loading...</div> -->
    <div class="form-group pull-right col-lg-2">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'style' => 'margin-top: 24px;', 'onclick'=>'results()', 'name' => 'contact-button']) ?>
    </div> 
<?php ActiveForm::end(); ?>
                
        </div>
    </div>
</div>
        
        

<!---->
        <div class="row">
        <div id="wait" style="display:none;position:absolute;top:50%;left:50%;padding:2px; z-index: 1000;">
            <img src='/img/ajaxloader.gif'/>
        </div>
        <div id="results"></div>  
        </div>
    </div>
</div>




<script>
$("#form_id").submit(function(){return false;});
	$("#form_id").submit(function(){return false;});
       function results(){
        var data = $("#form_id").serialize();
        $.ajax({
    			type: 'post',
    			url: '/site/results',
    			data: data,
                beforeSend: function() {
                   $("#wait").css("display", "block");               
                  },
    			success: function (response){
    			     $("#wait").css("display", "none");
    			     $( '#results' ).html(response);
                     //setTimeout( "$('#results').hide();", 4000);
    			}
            }); 
      }
    

 </script>
