<?php
    extract($result);
    //print_r($this->financial_report_model->financial_report_information('8zoLYo3YXb',[23],'2021-01-01'));
?>
<style>
.header{
    font-weight:bold;
    text-align:center;
    margin:15px;
}

.total_oc,.total_dt,.code_proof_of_cash{
    font-weight:bold;
}

.total_oc{
    color:purple;  
}

.total_dt{
    color:slateblue;
}

.code_proof_of_cash{
    color:hotpink;
}

</style>

<?php 
//print_r($result['month_active_projects']);
?>

<div class="row">
  <div class="col-xs-12">
      <?=Widget_base::load('comment');?>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
      <?=Widget_base::load('position','position_1');?>
  </div>
</div>

<div class="row">
    <div class='col-xs-12'>
        <div onclick="PrintElem('#voucher_print')" class="btn btn-default"><?=get_phrase('print');?></div>
    </div>
</div>    

</hr>

<div class="row">
    <div class="col-xs-12 header">
        <span id='office_names'><?=get_phrase('office');?>: <?=$office_names;?> </span></br>
        <?=get_phrase('month');?>: <?=date('F Y',strtotime($reporting_month));?> 
    </div>
</div>

<div class='row'>
    <div class='col-xs-12'>
        <form id='frm_selected_offices' action='<?=base_url();?>financial_report/filter_financial_report' method='POST'>
            <div class='form-group'>
                <label class='col-xs-2 control-label'><?=get_phrase('choose_offices_and_projects');?></label>
                
                <div class='col-xs-4'>
                    <!--Implement appending to searializeArray later to avoid hidden fields -->
                    <input type='hidden' value='<?=$this->id?>' name='report_id' />
                    <input type='hidden' value='<?=$reporting_month;?>' name='reporting_month' />

                    <select name='office_ids[]' id='office_ids' class='form-control select2' multiple>
                        <?php foreach($user_office_hierarchy as $context => $offices){?>
                            <optgroup label='<?=ucfirst($context);?>'>
                                
                                <?php 
                                    foreach($offices as $office){
                                        $selected = "";
                                        if(in_array($office['office_id'],$office_ids)) $selected = "selected";
                                        
                                ?>

                                    <option value='<?=$office['office_id'];?>' <?=$selected;?>><?=$office['office_name'];?></option>
                                <?php 
                                        
                                    }
                                ?>
                            </optgroup>
                        <?php }?>
                    </select>
                </div>
                
                <?php if(!$this->config->item('allow_a_bank_to_be_linked_to_many_projects')){?>
                <div class='col-xs-2'>
                    <select name='project_ids[]' id='project_ids' class='form-control select2' multiple ><?=get_phrase('select_projects');?>
                        <?php foreach($month_active_projects as $month_active_project){?>
                            <option value='<?=$month_active_project['project_id'];?>'><?=$month_active_project['project_name'];?></option>
                        <?php }?>
                    </select>
                </div>
                        <?php }else{?>

                <div class='col-xs-2'>
                    <select name='office_bank_ids[]' id='office_bank_ids' class='form-control select2' multiple ><?=get_phrase('select_office_banks');?>
                        <?php 
                            $office_bank_selected = ''; 
                            $cnt = 0;
                            
                            foreach($office_banks as $office_bank){
                                if($cnt == 0 && count($office_banks) == 1){
                                    $office_bank_selected = 'selected="selected"';
                                }
                        ?>
                                <option <?=$office_bank_selected;?> value='<?=$office_bank['office_bank_id'];?>'><?=$office_bank['office_bank_name'];?></option>
                        <?php 
                                $cnt++;
                            }  
                        ?>
                            
                    
                    </select>
                </div>
                <?php }?>

                <div class='col-xs-2'>
                     <i class='badge badge-info'></i>               
                    <button type='submit' id='merge_reports' class='btn btn-default <?=count($office_banks) == 1?'hidden':'';?>'><?=get_phrase('run');?></button>
                </div>
            </div>
        </form>
    </div>
</div>


<hr/>

<div class='row'>
    <div class='col-xs-12' style='overflow-x: auto' id='financial_report_row'>
        <?php include 'ajax_view.php';?>
    </div>
</div>

<script>


$("#frm_selected_offices").on('submit',function(ev){
    
    var url = $(this).attr('action');
    var office_ids = $("#office_ids").val();
    var project_ids = $("#project_ids").val();
    var office_bank_ids = $("#office_bank_ids").val();
    var data = $(this).serializeArray();
    
    if(office_ids == null){
        alert('Please select atleast 1 office to proceed');
        $("#office_ids").css('border','1px red solid');
    }else{ 
        $.post(url,data,function(response){
            
            $('#financial_report_row').html(response);
        });
    }  

     ev.preventDefault();
});

// $("#bank_statement_balance").on('click',function(){
//     //$(this).val(null);
// });

// $("#bank_statement_balance").on('change',function(){
//     ///alert('Hello');
//     var bank_statement_balance = $(this).val();
//     var url = "<?=base_url();?>financial_report/update_bank_statement_balance";
//     var reporting_month = "<?=$reporting_month;?>";
//     var statement_date = $('#bank_statement_date').val();
//     var book_closing_balance = '<?=$bank_reconciliation['book_closing_balance'];?>';
//     var month_outstanding_cheques = '<?=$bank_reconciliation['month_outstanding_cheques'];?>';
//     var month_transit_deposit = '<?=$bank_reconciliation['month_transit_deposit'];?>';
//     var office_id = "<?=$office_ids[0];?>";

//     var reconciled_balance = parseFloat(bank_statement_balance) - parseFloat(month_outstanding_cheques) + parseFloat(month_transit_deposit);

//     $("#reconciled_bank_balance").html(reconciled_balance);

//     var oldClass = "label-danger";
//     var newClass = "label-success";
//     var oldLabel = "Not Balanced";
//     var newLabel = "Balanced";
 
//     if(parseFloat(reconciled_balance) == parseFloat(book_closing_balance)){
//         newClass = "label-success";newLabel = "Balanced";
//     }else{
//         newClass = "label-danger";newLabel = "Not Balanced";
//     }
        
//     $("#reconciliation_flag").removeClass(oldClass).addClass(newClass);
//     $("#reconciliation_flag").html(newLabel);

//     $.ajax({
//         url:url,
//         type:"POST",
//         data:{'bank_statement_balance':bank_statement_balance,'reporting_month':reporting_month,'statement_date':statement_date,'office_id':office_id},
//         success:function(response){
//             alert(response);
//         }
//     });
// });


// $("#drop_statements").dropzone({
//     url: "<?=base_url()?>financial_report/upload_statements",
// });


function PrintElem(elem)
    {
        $(elem).printThis({ 
		    debug: false,              
		    importCSS: true,             
		    importStyle: true,         
		    printContainer: false,       
		    loadCSS: "", 
		    pageTitle: "<?php echo get_phrase('financial_report');?>",             
		    removeInline: false,        
		    printDelay: 333,            
		    header: null,             
		    formValues: true          
		});
    }
    


// $(document).ready(function(){
//     Dropzone.autoDiscover = false;
// });

// var myDropzone = new Dropzone("#drop_statements", { 
//         url: "<?=base_url()?>financial_report/upload_statements",
//         paramName: "file", // The name that will be used to transfer the file
//         params:{
//             'office_id':<?=$office_ids[0];?>,
//             'reporting_month':'<?=$reporting_month;?>',
//             'project_id': $("#project_ids").val()?$("#project_ids").val():'[]',
//             'office_bank_ids':$("#office_bank_ids").val()?$("#office_bank_ids").val():'[]'
//         },
//         maxFilesize: 5, // MB
//         uploadMultiple:true,
//         acceptedFiles:'image/*,application/pdf',    
//     });

//     // myDropzone.on("sending", function(file, xhr, formData) { 
//     // // Will sendthe filesize along with the file as POST data.
//     // formData.append("filesize", file.size);  

//     // });

//     myDropzone.on("complete", function(file) {
//         //myDropzone.removeFile(file);
//         myDropzone.removeAllFiles();
//         //alert(myDropzone.getAcceptedFiles());
//     }); 

//     myDropzone.on("success", function(file,response) {
//         alert(response);
//         if(response == 0){
//             alert('Error in uploading files');
//             return false;
//         }
//         var table_tbody = $("#tbl_list_statements tbody");
//         var obj = JSON.parse(response);

//         for (let i = 0; i < obj.file.name.length; i++) {
//             table_tbody.append('<tr><td><a href="#" class="fa fa-trash-o delete_statement" id="uploads/attachments/financial_report/'+obj.financial_report_id+'/'+obj.file.name[i]+'"></a></td><td><a target="__blank" href="<?=base_url();?>uploads/attachments/financial_report/'+obj.financial_report_id+'/'+obj.file.name[i]+'">'+obj.file.name[i]+'</a></td><td>'+obj.file.size[i]+'</td><td><?=date('Y-m-d');?></td></tr>');
//         }

//     });  


//     $(document).on('click','.delete_statement',function(){
 
//         var file_path = $(this).attr('id');
//         var url = "<?=base_url();?>financial_report/delete_statement";
//         var data = {'path':file_path};

//         $.ajax({
//             url:url,
//             data:data,
//             type:"POST",
//             success:function(response){
//                 alert(response);
//                 $(".delete_statement").closest('tr').remove();
//             }
//         });
        
//     }); 
</script>