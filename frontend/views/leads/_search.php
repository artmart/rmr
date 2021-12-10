<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Leads;
use yii\helpers\ArrayHelper;
?>

<div class="leads-search">
    <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get', 'options' => ['data-pjax' => 1]]); ?>
    <?php // $form->field($model, 'lead_id') ?>
    <?= $form->field($model, 'param_id')->hiddenInput()->label(false); ?>
<div class="form-group col-lg-1">
    <?= $form->field($model, 'id') ?>
</div>
    <?php // $form->field($model, 'created') ?>
<div class="form-group col-lg-3">
    <?= $form->field($model, 'created_iso')->textInput(['class'=>'form-control reportrange']) ?>
</div>
    <?php // echo $form->field($model, 'changed') ?>
<div class="form-group col-lg-3">
    <?php echo $form->field($model, 'changed_iso')->textInput(['class'=>'form-control reportrange']) ?>
</div>
    <?php // echo $form->field($model, 'customer') ?>
<div class="form-group col-lg-2">
    <?php echo $form->field($model, 'status')->dropDownList(ArrayHelper::map(Leads::find()->asArray()->all(), 'status', 'status'), ['prompt'=>'- Select -', 'class'=>'form-control'])?>
</div>
    <?php // echo $form->field($model, 'activity') ?>

    <?php // echo $form->field($model, 'event') ?>

    <?php // echo $form->field($model, 'converted_bookings') ?>
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
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
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