<?php

$has_details_table = $this->grants->check_if_table_has_detail_table($this->controller);
$has_details_listing = $this->grants->check_if_table_has_detail_listing($this->controller);
$show_add_button = $this->grants->show_add_button();
?>


<div class="">
<?php echo form_open('' , array('id'=>'form-filter','class' => 'form-vertical form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

		<div class="row">
			<div class="col-xs-12">
				<?=Widget_base::load('view');?>
			</div>
		</div>

	

		<div class="row">
			<div class="col-xs-12" style="text-align:center;">

				<?php
				if($show_add_button){
				  echo add_record_button($this->controller, $has_details_table,null,$has_details_listing);
				}
				?>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
			<table id="ajax_table" class="table table-bordered hover" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th><?=get_phrase('action');?></th>
						<?php 
							$columns = $this->grants->toggle_list_select_columns();
							foreach($columns as $column){
								if($this->grants->is_primary_key_field($this->controller,$column)){
									continue;
								}

								if(strpos($column,'_name') == true){
									$column = str_replace("_name","",$column);
								}
							?>	
								<th><?=get_phrase($column);?></th>
							<?php
							}
						?>
					</tr>
				</thead>
			</table>		
			</div>
		</div>			

 </form>   
    </div>


    <script>
	$(document).ready(function(){ 
		   
		var datatable = $('#ajax_table').DataTable({
		       dom: '<Blf><"col-sm-12"rt><ip>',
			   lengthMenu: [
					[ 10, 25, 50, 100, 150, 200, -1 ],
					[ 
						'10 <?=get_phrase('records');?>', 
						'25 <?=get_phrase('records');?>', 
						'50 <?=get_phrase('records');?>', 
						'100 <?=get_phrase('records');?>', 
						'150 <?=get_phrase('records');?>', 
						'200 <?=get_phrase('records');?>', 
						'<?=get_phrase('show_all');?>' ]
					],
		       pagingType: "full_numbers",
			   buttons: [
					{
						extend: 'excelHtml5',
						text: '<?=get_phrase('export_in_excel');?>',
						className: 'btn btn-default',
						exportOptions: {
						columns: 'th:not(:first-child)'
						}
					},
					{
						extend:'pdfHtml5',
						className: 'btn btn-default',
						text:'<?=get_phrase('export_in_PDF');?>',
						orientation: 'landscape',
						exportOptions:{
							columns: 'th:not(:first-child)'
						}
					},
					// {
					// 	text: '<?=get_phrase('add_'.$this->controller)?>',
					// 	className: 'btn btn-default',
					// 	action: function ( e, dt, node, config ) {
					// 		alert( 'Button not yet functional' );
					// 	}
					// }
				],
		       stateSave: true,
		       oLanguage: {
			        sProcessing: "<img src='<?php echo base_url();?>assets/uploads/preloader4.gif'>"
			    },
			   processing: true, //Feature control the processing indicator.
		       serverSide: true, //Feature control DataTables' server-side processing mode.
		       order: [], //Initial no order.
		
		       // Load data for the table's content from an Ajax source
		       "ajax": {
		           "url": "<?php echo base_url();?><?=$this->controller;?>/list_ajax",
		           "type": "POST",
		           "data": function(data){
		           		var x = $("#form-filter").serializeArray();

						$.each(x, function(i, field){
								data[field.name] = field.value;
						});
		           }
		       },
			   
		       
		   });


	});
</script>