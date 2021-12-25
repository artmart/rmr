<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="payments-search">

    <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get', 'options' => ['data-pjax' => 1]]); ?>

    <?php //$form->field($model, 'payment_id') ?>

    <?php // $form->field($model, 'param_id') ?>
    <?=$form->field($model, 'param_id')->hiddenInput()->label(false);?>
<div class="form-group col-lg-2">
    <?= $form->field($model, 'id') ?>
</div>
<div class="form-group col-lg-2">
    <?= $form->field($model, 'transaction_id') ?>
</div>
<div class="form-group col-lg-2">
    <?= $form->field($model, 'label') ?>
</div>
<div class="form-group col-lg-3">
    <?= $form->field($model, 'created_iso')->textInput(['class'=>'form-control reportrange']) ?>    
</div>
    <?php // echo $form->field($model, 'parts') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'original_amount') ?>

    <?php // echo $form->field($model, 'refunded_amount') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'gratuity') ?>

    <?php // echo $form->field($model, 'booking_id') ?>

    <?php // echo $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'submitter') ?>

<div class="form-group col-lg-1">
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'style' => 'margin-top: 24px;']) ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
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
