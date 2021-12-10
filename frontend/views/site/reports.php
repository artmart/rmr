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
    
    'sales_report'=>['title' => 'sales_report', 'filters'=>['start_end', 'tax_rate'], 'report_type'=>'standard1'],
    
    
    'amount-paid-per-booking'=>['title' => 'Amount paid per booking', 'filters'=>['start_end']],
    
    
    
    
    //'individual-contractors-links'=>['title' => 'Individual contractors links', 'filters'=>['start_end', 'contractors_name']],
    //'link-anchors'=>['title' => 'Link Anchors', 'filters'=>['url']],
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
   
/*
    if($filter== 'contractors_name'){?>
		<div class="form-group">
            <input type="text" class="form-control" id="contractors_name" name="contractors_name" placeholder="Contractors Name">
	    </div>
    <?php }
    */
       
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
	//	$(".selectpicker").selectpicker({
	//		noneSelectedText: 'Select SKU'
	//	});

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