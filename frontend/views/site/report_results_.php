<?php  
	ini_set('memory_limit', '512M');
	ini_set('max_execution_time', 3000);

//var_dump($model->scope);  //$model->key  $model->secret
//exit;
       /* 
			$table2JsonData[] = array(
				$q->category,
				$q->sale_status,
				$q->tmstamp,
				"R" . number_format($unit_price, 2, '.', ''),
                $q->quantity,
				"R" . number_format($q->selling_price, 2, '.', ''),
				"R" . number_format($q->total_product_cost, 2, '.', ''),
				"R" . number_format($total_paid_to_gretmol_inc_vat, 2, '.', ''),
				"R" . number_format($total_paid_to_gretmol_inc_vat / $vat, 2, '.', ''),
                "R" . number_format($q->selling_price - $q->total_product_cost - $takealot_fees, 2, '.', ''),
				"R" . number_format($takealot_fees, 2, '.', ''),
				number_format($margin_ex_vat, 2) ."%",
				number_format($margin_ex_vat / $vat, 2) ."%",
                "R" . number_format($qp_on_takealot_payout_vat_inc, 2, '.', ''),
				number_format($gp) . "%",
			); 

      
*/
$show_table = 1;
$event_types_arr = [];
foreach(json_decode($event_types) as $et){
    $event_types_arr[] = [$et->id, $et->label];
}
//$event_types_keys = ['Id', 'Label'];
	?>

	<div class="row">
		<div class="col-md-12">







 <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
        Event Types</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
      <div class="panel-body">
        <?php if ($show_table) { ?>
        <table id="event_types" class="table  table-success dataTable draggable" width="100%">
            <thead>
        		<tr>
        			<th><strong>ID</strong></th>
        			<th><strong>Label</strong></th>
        		</tr>
        	</thead>
        	<tbody></tbody>
        </table>
        <?php } else {
        echo "<center><img style='height: 100%;' src='/img/nodata.png'/></center>";
        } ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        Collapsible Group 2</a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
        Collapsible Group 3</a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
</div> 









		</div>
	</div>
    
    
    

<script>
//Datatable//
$(document).ready(function(){
    
$('#event_types').DataTable({
    data: <?php echo json_encode($event_types_arr); ?>,
	//scrollX: '100%',
	//scrollCollapse: true,
	responsive: true,
	"ordering": true,
	"paging": true,
	"searching": true,
	"info": true,
    //colReorder: true,
	"columnDefs": [
                    {targets: 0, width: 150},
                    {targets: 1, width: 100},
	],
dom: "RflBrtip",
//'colReorder': true,
//"pageLength": 100,
buttons: [
            {extend: "copy", className: "btn-sm"},
	        {extend: "csv", className: "btn-sm"},
	        //{extend: "excel", className: "btn-sm"},
         ],

}); 
});
</script>
<?php exit; ?>