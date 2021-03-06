<style>
	#example2 {
		table-layout: fixed !important;
		word-wrap: break-word;
	}

	div.dataTables_scrollBody thead th,
	div.dataTables_scrollBody thead td {
		line-height: 0;
		opacity: 0.0;
		width: 0px;
		height: 0px;
	}

	div.dataTables_wrapper {
		width: 100%;
		margin: 0 auto;
	}
    
</style>
<?php
ini_set('memory_limit', '512M');
ini_set('max_execution_time', 300);

$query_params = [
    'tax-exempt-bookings'=>['title' => 'Tax exempt bookings', 'filters'=>['start_end', 'tax_rate'], 'report_type'=>'standard'],
    'tax-collected-total'=>['title' => 'Tax collected total', 'filters'=>['start_end', 'tax_rate'], 'report_type'=>'standard'],
    'booking-report-results'=>['title' => 'Booking Results', 'filters'=>['start_end', 'tax_rate', 'booking_id', 'unit', 'unit_type', 'status'], 'report_type'=>''],
    'list-chart-of-payments-via-method'=>['title' => 'List/chart of payments via method', 'filters'=>['start_end'], 'report_type'=>'standard1'],    
    'bookings-with-no-payments-made'=>['title' => 'Bookings With No Payments Made', 'filters'=>['start_end'], 'report_type'=>'standard'],
    'bookings-with-an-extra'=>['title' => 'Bookings With An Extra', 'filters'=>['start_end'], 'report_type'=>'standard'],
    'list-of-bookings-with-multiple-extras'=>['title' => 'List Of Bookings With Multiple Extras', 'filters'=>['start_end', 'extras'], 'report_type'=>'standard'],
    'list-of-bookings-with-specific-unit-types'=>['title' => 'List Of Bookings With Specific Unit Types', 'filters'=>['start_end', 'unit_type_multiple'], 'report_type'=>'standard'],
    'list-of-bookings-with-specific-unit'=>['title' => 'List Of Bookings With Specific Unit', 'filters'=>['start_end', 'unit_multiple'], 'report_type'=>'standard'],
    'time-between-lead-submitted-and-converted'=>['title' => 'Time Between Lead Submitted And Converted', 'filters'=>['event_types'], 'report_type'=>'standard'],
];

$this->title = $query_params[$query]['title'];
?>
<h1><?php echo $this->title; ?></h1>
<hr />

<div class="body-content animated fadeIn">

<form id="form_id" class="form">

 <input type="hidden" id="query" name="query" value="<?php echo $query; ?>">
 <input type="hidden" id="param_id" name="param_id" value="<?php echo $param_id; ?>">
 <input type="hidden" id="report_type" name="report_type" value="<?php echo $query_params[$query]['report_type']; ?>">
 
<?php 
if(count($query_params[$query]['filters'])>0){ ?>
<div class="well">
<?php
foreach($query_params[$query]['filters'] as $filter){
    if($filter== 'start_end'){ ?>
		<div class="form-group col-md-4">
        <label for="created_iso">Created ISO</label>
		<input type="hidden" id="start" name="start" value="">
		<input type="hidden" id="end" name="end" value="">
		<div id="reportrange" class="form-control">
			<i class="fa fa-calendar"></i>&nbsp;
			<span></span> <i class="fa fa-caret-down"></i>
		</div>
		</div>
    <?php }
      if($filter== 'tax_rate'){?>
		<div class="form-group col-md-2">
            <label for="tax_rate">Tax Rate</label>
            <input type="text" class="form-control" id="tax_rate" name="tax_rate" placeholder="Tax Rate">
	    </div>
    <?php }    
      if($filter== 'booking_id'){?>
		<div class="form-group col-md-2">
            <label for="booking_id">Booking Id</label>
            <input type="text" class="form-control" id="booking_id" name="booking_id" placeholder="Booking Id">
	    </div>
    <?php } 
   
    if($filter== 'unit_type_multiple'){  
        $unittype = frontend\models\Unittypes::find()->where(['param_id'=> $param_id])->asArray()->all();
        ?>
		<div class="form-group col-md-2">
            <label for="unit_type_multiple">Unit Type</label>
            <select class="form-control selectpicker" id="unit_type_multiple" name="unit_type_multiple[]" multiple>
                <option value="">-Select-</option>
            <?php if(count($unittype)>0){
                foreach($unittype as $ut){ ?>
				<option value="<?=$ut['id']?>"><?=$ut['label']?></option>
                <?php }} ?>
			</select>
	    </div>
    <?php }
       
    if($filter== 'unit_type'){  
        $unittype = frontend\models\Unittypes::find()->where(['param_id'=> $param_id])->asArray()->all();
        ?>
		<div class="form-group col-md-2">
            <label for="unit_type">Unit Type</label>
            <select class="form-control" id="unit_type" name="unit_type">
                <option value="">-Select-</option>
            <?php if(count($unittype)>0){
                foreach($unittype as $ut){ ?>
				<option value="<?=$ut['id']?>"><?=$ut['label']?></option>
                <?php }} ?>
			</select>
	    </div>
    <?php } 
    if($filter== 'unit_multiple'){  
        $units = frontend\models\Units::find()->where(['param_id'=> $param_id])->asArray()->all();
        ?>
		<div class="form-group col-md-2">
            <label for="unit">Unit</label>
            <select class="form-control selectpicker" id="unit_multiple" name="unit_multiple[]" multiple>
                <option value="">-Select-</option>
            <?php if(count($units)>0){
                foreach($units as $u){ ?>
				<option value="<?=$u['id']?>"><?=$u['label']?></option>
                <?php }} ?>
			</select>
	    </div>
    <?php }    
    
    if($filter== 'unit'){  
        $units = frontend\models\Units::find()->where(['param_id'=> $param_id])->asArray()->all();
        ?>
		<div class="form-group col-md-2">
            <label for="unit">Unit</label>
            <select class="form-control" id="unit" name="unit">
                <option value="">-Select-</option>
            <?php if(count($units)>0){
                foreach($units as $u){ ?>
				<option value="<?=$u['id']?>"><?=$u['label']?></option>
                <?php }} ?>
			</select>
	    </div>
    <?php } 
    if($filter== 'status'){  
       $status = ["Unconfirmed"=>"Unconfirmed", "Confirmed"=>"Confirmed", "Customer Details Confirmed"=>"Customer Details Confirmed", "Cancelled"=>"Cancelled", "Postponed"=>"Postponed"];
        ?>
		<div class="form-group col-md-2">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="">-Select-</option>
            <?php 
                foreach($status as $s){ ?>
				<option value="<?=$s?>"><?=$s?></option>
                <?php } ?>
			</select>
	    </div>
    <?php }
    if($filter== 'extras'){  
       $extras = frontend\models\Extras::find()->where(['param_id'=> $param_id])->asArray()->all();;
        ?>
		<div class="form-group col-md-2">
            <label for="status">Extras</label>
            <select class="form-control selectpicker" id="extras" name="extras[]" multiple>
                <option value="">-Select-</option>
                <?php if(count($extras)>0){
                foreach($extras as $u){ ?>
				<option value="<?=$u['id']?>"><?=$u['label']?></option>
                <?php }} ?>
			</select>
	    </div>
    <?php }  
    
    if($filter== 'event_types'){  
       $event_types = frontend\models\Eventtypes::find()->where(['param_id'=> $param_id])->asArray()->all();;
        ?>
		<div class="form-group col-md-2">
            <label for="status">Event types</label>
            <select class="form-control selectpicker" id="event_types" name="event_types[]" multiple>
                <option value="">-Select-</option>
                <?php if(count($event_types)>0){
                foreach($event_types as $u){ ?>
				<option value="<?=$u['label']?>"><?=$u['label']?></option>
                <?php }} ?>
			</select>
	    </div>
    <?php }          
} 
?>  
<button class="btn btn-primary" style="margin-top: 24px;" onclick="showValues()">Run</button>
<div class="clearfix"></div> 
</div>
        
<?php

}else{ ?>

<script>
$(document).ready(function(){showValues();});
</script>

<?php } ?>

</form>
<center>
<div id="my_loader"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> </div>
</center>
<div id="calc-results" class="row"></div>
</div>
<script type="text/javascript">
$("#my_loader").css("display", "none");
	$(function() {
		$(".selectpicker").selectpicker({
			noneSelectedText: '- Select -'
		});

		var start = moment().subtract(29, 'days');
		var end = moment();

		$('#start').val(start.format('YYYY-MM-D'));
		$('#end').val(end.format('YYYY-MM-D'));

		function cb(start, end) {
			$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

			$('#start').val(start.format('YYYY-MM-D'));
			$('#end').val(end.format('YYYY-MM-D'));
		}

		$('#reportrange').daterangepicker({
			startDate: start,
			endDate: end,
			autoUpdateInput: true,
			ranges: {
				//'Today': [moment(), moment()],
				//'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
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



	//	$('#reportrange').on('apply.daterangepicker', function(ev, picker) {
	//		showValues();
	//});

	});

	$("#form_id").submit(function(){return false;});
//document.getElementById("form_id").addEventListener("click", function(event){event.preventDefault()});
	function showValues() {

		var data = $("#form_id").serialize();

		$.ajax({
			type: 'post',
			url: '/site/reportresults',
			data: data,
			beforeSend: function() {
				$("#my_loader").css("display", "block");
			},
			success: function(response) {
				$("#my_loader").css("display", "none");
				$('#calc-results').html(response);
			}
		});
	}


	//$(document).ready(function(){showValues();});
</script>