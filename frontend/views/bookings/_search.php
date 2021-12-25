<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="bookings-search">
    <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get', 'options' => ['data-pjax' => 1]]); ?>
    <?php // $form->field($model, 'booking_id') ?>
    <?php // $form->field($model, 'param_id') ?>
    <?=$form->field($model, 'param_id')->hiddenInput()->label(false);?>
    
    <div class="form-group col-lg-1">
    <?= $form->field($model, 'id') ?>
    </div>
    <div class="form-group col-lg-3">
    <?= $form->field($model, 'created_iso')->textInput(['class'=>'form-control reportrange']) ?>    
    </div>
    <div class="form-group col-lg-3">
    <?php // $form->field($model, 'created') ?>
    <?php echo $form->field($model, 'changed_iso')->textInput(['class'=>'form-control reportrange']) ?>
    </div>

    <?php // echo $form->field($model, 'changed') ?>
<div class="form-group col-lg-2">
    <?= $form->field($model, 'status')->dropDownList(["Unconfirmed"=>"Unconfirmed", "Confirmed"=>"Confirmed", "Customer Details Confirmed"=>"Customer Details Confirmed", "Cancelled"=>"Cancelled", "Postponed"=>"Postponed"] , ['prompt'=>'- Select -']); ?>
</div>
    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'customer') ?>

    <?php // echo $form->field($model, 'staff') ?>

    <?php // echo $form->field($model, 'rep') ?>

    <?php // echo $form->field($model, 'vehicle') ?>

    <?php // echo $form->field($model, 'assets') ?>

    <?php // echo $form->field($model, 'packages') ?>

    <?php // echo $form->field($model, 'extras') ?>

    <?php // echo $form->field($model, 'event_name') ?>

    <?php // echo $form->field($model, 'event') ?>

    <?php // echo $form->field($model, 'venue') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <?php // echo $form->field($model, 'signature_required') ?>

    <?php // echo $form->field($model, 'signature') ?>

    <?php // echo $form->field($model, 'travel') ?>

    <?php // echo $form->field($model, 'template') ?>

    <?php // echo $form->field($model, 'taxjar') ?>

    <?php // echo $form->field($model, 'ein') ?>

    <?php // echo $form->field($model, 'tax_rate') ?>
    
    <div class="form-group col-lg-1">
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'style' => 'margin-top: 24px;']) ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary', 'style' => 'margin-top: 24px;']) ?>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
	$(function(){
		var start = moment().subtract(29, 'days');
		var end = moment();

	//	$('#start').val(start.format('YYYY-MM-D'));
	//	$('#end').val(end.format('YYYY-MM-D'));

		function cb(start, end) {
			$('.reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            //$('.reportrangee').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			//$('#start').val(start.format('YYYY-MM-D'));
			//$('#end').val(end.format('YYYY-MM-D'));
		}

		$('.reportrange').daterangepicker({
		//	startDate: start,
		//	endDate: end,
			autoUpdateInput: false,
			ranges: {
				'Next 7 Days': [moment(), moment().add(6, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				//'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
                
                'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
				'This Year': [moment().startOf('year'), moment().endOf('year')],
			}
		}, cb);

		cb(start, end);
        
        
        $('.reportrange').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('MM/D/YYYY') + ' - ' + picker.endDate.format('MM/D/YYYY'));
            });

            $('.reportrange').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });

	//	$('#reportrange').on('apply.daterangepicker', function(ev, picker) {
	//		showValues();
	//});

	});
</script>
