<style>
th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        margin: 0 auto;
    }
 
    div.container {
        width: 80%;
    }
</style>
<?php
ini_set('memory_limit', '512M');
ini_set('max_execution_time', 3000);
    
	$show_table = false;
    $show_chart = false;
	
	$where = ' 1 = 1 ';
    
    $start = '';
    $end = '';
    $url = '';
    $contractors_name = '';
    $tax_rate = '';
    $booking_id = '';
    $status = '';
    $unit = '';
    $unit_type = '';
    
    $where = ' 1 = 1 ';
    
    $query = $_REQUEST['query'];
    $param_id = $_REQUEST['param_id'];
    
	if(isset($_REQUEST['start']) && $_REQUEST['start'] !== ''){ $start = Date("Y-m-d", strtotime($_REQUEST['start']));}
	if(isset($_REQUEST['end']) && $_REQUEST['end'] !== ''){$end = Date("Y-m-d", strtotime($_REQUEST['end'])); }
   /*	if(isset($_REQUEST['tax_rate']) && $_REQUEST['tax_rate'] !== ''){
   	    $tax_rate = $_REQUEST['tax_rate'];
        $where .= " And b.tax_rate = '$tax_rate' ";
    }
   	if(isset($_REQUEST['booking_id']) && $_REQUEST['booking_id'] !== ''){
   	    $booking_id = $_REQUEST['booking_id'];
        $where .= " And b.id = '$booking_id' ";
    }
   	if(isset($_REQUEST['unit']) && $_REQUEST['unit'] !== ''){
   	    $unit = $_REQUEST['unit'];
        $where .= " And JSON_CONTAINS(JSON_KEYS(b.assets->>'$.units'),  CONCAT('\"', '$unit', '\"')) ";
    }
   	if(isset($_REQUEST['status']) && $_REQUEST['status'] !== ''){
   	    $status = $_REQUEST['status'];
        $where .= " And b.status = '$status' ";
    }
   	if(isset($_REQUEST['unit_type']) && $_REQUEST['unit_type'] !== ''){
   	    $unit_type = $_REQUEST['unit_type'];
        $where .= " And JSON_CONTAINS(JSON_KEYS(b.assets->>'$.unit_types'),  CONCAT('\"', '$unit_type', '\"')) ";
    }
    */
    

    
$query_params = [
    'list-chart-of-payments-via-method'=>['title' => 'List/chart of payments via method', 
         'sql' => "SELECT p.source, 
                    SUM(parts->'$.subtotal.original_amount') subtotal_original_amount,
                    SUM(parts->'$.subtotal.refunded_amount') subtotal_refunded_amount,
                    SUM(parts->'$.subtotal.amount') subtotal_amount,
                    SUM(parts->'$.tax.original_amount') tax_original_amount,
                    SUM(parts->'$.tax.refunded_amount') tax_refunded_amount,
                    SUM(parts->'$.tax.amount') tax_amount,
                    SUM(original_amount) original_amount, 
                    SUM(refunded_amount) refunded_amount, 
                    SUM(amount) amount,
                    SUM(gratuity) gratuity,
                    COUNT(id) number_of_payments
                    FROM payments p
                    where ". $where ." and p.param_id ='$param_id' AND p.created_iso Between '$start' And '$end'
                    GROUP BY p.source",

         'columns'=>['source', 'subtotal_original_amount', 'subtotal_refunded_amount', 'subtotal_amount',
                     'tax_original_amount', 'tax_refunded_amount', 'tax_amount', 'original_amount', 'refunded_amount', 'amount', 'gratuity', 'number_of_payments'],
         'chart'=>''    
    ],    
];

$series = [];
//table data//
$table_th = '';
$cn = [];
foreach($query_params[$query]['columns'] as $c){$ct = ucwords(str_replace("_"," ",$c)); $table_th .= '<th><strong>'.$ct.'</strong></th>';}
//table results//                  
$connection = Yii::$app->getDb();
$command = $connection->createCommand($query_params[$query]['sql']);
$query_res = $command->queryAll();
$cnt = count($query_res);
$table2JsonData = [];
$table2JsonData1 = [];
	if ($cnt> 0){
		$show_table = true;
        $show_chart = true;

		for($a=0; $a<$cnt; $a++){
            foreach($query_params[$query]['columns'] as $c){
                $table2JsonData[$a][] = $query_res[$a][$c];
                $table2JsonData1[$a][] = floatval($query_res[$a][$c]);
                }
            $series[] = ['name'=>$query_res[$a]['source'], 'data'=>$table2JsonData1[$a]];
		}  
	}
?>

<div class="row">
<div class="col-md-12">
	<div class="panel panel-default shadow">
		<div class="panel-heading">
			<div class="pull-left">
				<h3 class="panel-title">Chart</h3>
			</div>
			<div class="pull-right">
				<button class="btn btn-sm option" id="line" data-toggle="tooltip" data-placement="top" data-title="Line Chart"><i class="fa fa-line-chart" aria-hidden="true"></i></button>
				<button class="btn btn-sm option" id="bar" data-toggle="tooltip" data-placement="top" data-title="Bar Chart"><i class="fa fa-bar-chart fa-rotate-90" aria-hidden="true"></i></button>
				<button class="btn btn-sm option" id="column" data-toggle="tooltip" data-placement="top" data-title="Column Chart"><i class="fa fa-bar-chart" aria-hidden="true"></i></button>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body" style="padding: 0;">
			<div class="ct-chart ct-month-inventory" style="height: 370px;">
				<?php if ($show_chart) { ?>
					<div id="container1" style="min-width: 100%; height: 100%; margin: 0 auto"></div>
				<?php } else {
					echo "<center><img style='height: 100%;' src='".Yii::getAlias('/img/nodata.png')."'/></center>";
				} ?>
			</div>
		</div>
	</div>
</div>
</div>
    
<div class="clearfix"></div>

<div class="row">
<div class="yscroll1">  

<div class="col-md-12">

<div class="panel panel-default shadow">
	<div class="panel-heading">
		<div class="pull-left">
			<h3 class="panel-title">Results</h3>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		<div class="ct-chart ct-month-inventory yscroll1">
			<?php if($show_table){ ?>
			<table id="example2" class="table table-striped draggable" style="width:100%">
			<thead><tr><?php echo $table_th; ?></tr></thead>
			<tbody></tbody>
			</table>
			<?php }else{echo "<center><img style='height: 100%;' src='".Yii::getAlias('/img/nodata.png')."'/></center>";} ?>
		</div>
	</div>
</div>
</div>
</div>
</div>
<script>
	//Highchart//
	$(function() {
		var chartype = 'line';
		setDynamicChart(chartype);

		$('.option').click(function() {
			var chartype = $(this).attr('id');
			setDynamicChart(chartype);
		});

		function setDynamicChart(chartype) {
			Highcharts.setOptions({
				lang: {decimalPoint: '.', thousandsSep: ','}
			});

			Highcharts.chart('container1', {
				colors: ['#81b71a', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
				chart: {type: chartype},
				title: {text: 'Results'},
				subtitle: {text: ''},
				xAxis: {
					type: 'category',
					/*categories: <?php //echo json_encode($chart_categories); ?>,*/ 
                    scrollbar: {enabled: false},
					//min: 0,
				//	max: 1
				},
				yAxis: {
					type: 'category',
					title: {text: ''},
					labels: {
						formatter: function(){return Highcharts.numberFormat(this.value, 0);}
					},
					//scrollbar: {enabled: true},
					//min: 0,
				//	max: 500,
				},
				plotOptions: {
					line: {
						dataLabels: {enabled: true} /*, enableMouseTracking: true*/
					},
                    series: {turboThreshold: 0}
				},
				tooltip: {
					yDecimals: 2, // If you want to add 2 decimals
					valueDecimals: 2
				},
				credits: {enabled: false},
				series: <?php echo json_encode($series); ?>
			});
		}
	});


//Datatable//
$(document).ready(function(){
	var table = $('#example2').DataTable({
		data: <?php echo json_encode($table2JsonData); ?>,            
		scrollX: '100%',
		scrollCollapse: true,
		//responsive: true,
		"ordering": false,
		"paging": true,
		"searching": true,
		"info": true,
        fixedColumns: true,
        
        //"autoWidth": false,
        //colReorder: true,
	/*	"columnDefs": [
			{targets: 0, width: 150},
			{targets: 1, width: 100},
			{targets: 2, width: 100},
			{targets: 3, width: 100},
			{targets: 4, width: 100},
			{targets: 5, width: 100},
			{targets: 6, width: 100},
			{targets: 7, width: 100},
			{targets: 8, width: 100},
			{targets: 9, width: 100},
			{targets: 10, width: 100},
			{targets: 11, width: 100},
			{targets: 12, width: 100},
			{targets: 13, width: 100},
			{targets: 14, width: 100},
			{targets: 15, width: 100},
			//{targets: 16, width: 100}
		],*/
		dom: "RflBrtip",
		//'colReorder': true,
		//"pageLength": 100,
		buttons: [
			{extend: "copy", className: "btn-sm"},
			{extend: "csv", className: "btn-sm"},
			{extend: "excel", className: "btn-sm"},                
		],

	});
    //table.column( 2 ).data().sum();
    table.columns.adjust().draw( false );
    
});
</script>