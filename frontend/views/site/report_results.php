<style>
.dataTables_filter{
    float: right;
}
</style>

<?php
ini_set('memory_limit', '512M');
ini_set('max_execution_time', 3000);
    
	$show_table = false;
	
	$where = ' 1 = 1 ';
    
    $start = '';
    $end = '';
    $url = '';
    $contractors_name = '';
    $tax_rate = '';
    
    $where = ' 1 = 1 ';
    
    $query = $_REQUEST['query'];
    $param_id = $_REQUEST['param_id'];
    
	if(isset($_REQUEST['start']) && $_REQUEST['start'] !== ''){ $start = Date("Y-m-d", strtotime($_REQUEST['start']));}
	if(isset($_REQUEST['end']) && $_REQUEST['end'] !== ''){$end = Date("Y-m-d", strtotime($_REQUEST['end'])); }
   	if(isset($_REQUEST['tax_rate']) && $_REQUEST['tax_rate'] !== ''){
   	    $tax_rate = $_REQUEST['tax_rate'];
        $where .= " And b.tax_rate = '$tax_rate' ";
       }
    if(isset($_REQUEST['contractors_name']) && $_REQUEST['contractors_name'] !== ''){$contractors_name = $_REQUEST['contractors_name'];}
    
$query_params = [

    'tax-exempt-bookings'=>['title' => 'Tax exempt bookings', 
         'sql' => "SELECT b.id booking_id, b.created_iso, u.label unit, ut.label unit_type, pac.label package, pac.price package_price, 
                   ext.label extras_label, ext.price extras_price, ext.upsell_price extras_upsell_price,
                   b.price->>'$.total' price, b.price->>'$.total_override' total_override,  b.ein FROM  bookings b
                   
                   Left JOIN units u ON JSON_CONTAINS(JSON_KEYS(b.assets->>'$.units'),  CONCAT('\"', u.id, '\"'))
                   Left JOIN unit_types ut ON JSON_CONTAINS(JSON_KEYS(b.assets->>'$.unit_types'),  CONCAT('\"', ut.id, '\"'))
                   Left JOIN packages pac ON JSON_CONTAINS(JSON_KEYS(b.assets->>'$.packages'),  CONCAT('\"', pac.id, '\"'))
                   left JOIN extras ext ON JSON_CONTAINS(JSON_KEYS(b.assets->>'$.extras'),  CONCAT('\"', ext.id, '\"'))
                   
                   where ". $where ." and b.param_id ='$param_id' AND b.created_iso Between '$start' And '$end' ",
         'columns'=>['booking_id', 'created_iso', 'unit', 'unit_type', 'package', 'package_price', 'extras_label', 'extras_price', 'extras_upsell_price', 'price', 'ein'],
         'chart'=>''    
    ],
    'tax-collected-total'=>['title' => 'Tax collected total', 
         'sql' => "SELECT SUM(b.tax_rate) total_of_tax_rate, SUM(b.price->>'$.total') total_of_price, 
                    SUM(b.price->>'$.total_override') total_override, SUM(b.price->>'$.remaining_balance') total_remaining_balance,
                    SUM(p.original_amount) total_original_amount, SUM(p.refunded_amount) total_refunded_amount, SUM(p.amount) total_amount,
                    COUNT(p.id) total_number_of_payments, COUNT(b.id) total_number_of_bookings
                    FROM  bookings b INNER JOIN payments p ON p.booking_id = b.id
                    where ". $where ." and b.param_id ='$param_id' AND b.created_iso Between '$start' And '$end' ",
         'columns'=>['total_of_tax_rate', 'total_of_price', 'total_override', 'total_remaining_balance', 'total_original_amount', 'total_refunded_amount', 
                     'total_amount', 'total_number_of_payments', 'total_number_of_bookings'],
         'chart'=>''    
    ],    
    
    
    
    
    
    'amount-paid-per-booking'=>['title' => 'Amount paid per booking', 
         'sql' => "SELECT id booking_id, created_iso, price->>'$.total' price, price->>'$.total_override' total_override,  ein FROM  bookings 
                   where tax_rate = 0 and param_id ='$param_id' AND created_iso Between '$start' And '$end' ",
         'columns'=>['booking_id', 'created_iso', 'price', 'ein'],
         'chart'=>''
         
         
    ],
    
    
    
    'individual-contractors-links'=>['title' => 'Individual contractors links', 
         'sql' => "SELECT acquired_by, acquired_date, link_deleted, id, ip_number, cost, link_url, pa, da, anchor, tier, target_url, via_tier_1, via_tier_2, flagged_ip, paid_link
                    FROM table_one WHERE acquired_by='$contractors_name' AND acquired_date Between '$start' And '$end';",
         'columns'=>['acquired_by', 'acquired_date', 'link_deleted', 'id', 'ip_number', 'cost', 'link_url', 'pa', 'da', 'anchor', 'tier', 'target_url', 'via_tier_1', 'via_tier_2', 'flagged_ip', 'paid_link']
    ],
    'link-anchors'=>['title' => 'Link Anchors', 
         'sql' => "SELECT target_url, anchor, pa, da, ds, ts, tier, ip_number, link_url FROM table_one WHERE target_url Like '%$url%';",
         'columns'=>['target_url', 'anchor', 'pa', 'da', 'ds', 'ts', 'tier', 'ip_number', 'link_url']
    ],

];

$table_th = '';
$cn = [];
foreach($query_params[$query]['columns'] as $c){$ct = ucwords(str_replace("_"," ",$c)); $table_th .= '<th><strong>'.$ct.'</strong></th>';}
//table results//                  
$connection = Yii::$app->getDb();
$command = $connection->createCommand($query_params[$query]['sql']);
$query_res = $command->queryAll();
$cnt = count($query_res);
$table2JsonData = [];
	if ($cnt> 0){
		$show_table = true;

		for($a=0; $a<$cnt; $a++){
            foreach($query_params[$query]['columns'] as $c){$table2JsonData[$a][] = $query_res[$a][$c];}
		}  
	}
?>
<div class="yscroll1">  
<div class="row">
<div class="col-md-12">

<div class="panel panel-default shadow">
	<div class="panel-heading">
		<div class="pull-left">
			<h3 class="panel-title">Results</h3>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		<div class="ct-chart ct-month-inventory yscroll">
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
//Datatable//
$(document).ready(function(){
	var table = $('#example2').DataTable({
		data: <?php echo json_encode($table2JsonData); ?>,            
		//scrollX: '100%',
		//scrollCollapse: true,
		//responsive: true,
		"ordering": false,
		"paging": true,
		"searching": true,
		"info": true,
        
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