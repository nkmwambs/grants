<?php
    extract($result);
?>
<style>
.header{
    font-weight:bold;
    text-align:center;
    margin:15px;
}

.currency{
    
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

                <div class='col-xs-4'>
                    <select name='project_ids[]' class='form-control select2' multiple ><?=get_phrase('select_projects');?>
                        <?php foreach($month_active_projects as $month_active_project){?>
                            <option value='<?=$month_active_project['project_id'];?>'><?=$month_active_project['project_name'];?></option>
                        <?php }?>
                    </select>
                </div>

                <div class='col-xs-2'>
                     <i class='badge badge-info'></i>               
                    <button type='submit' id='merge_reports' class='btn btn-default'><?=get_phrase('run');?></button>
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

$("#submit_report").on('click',function(){
    var url = "<?=base_url();?>financial_report/submit_financial_report";
    var data = {'office_id':<?=$office_ids[0];?>,'reporting_month':'<?=$reporting_month;?>'};

    $.ajax({
        url:url,
        data:data,
        type:"POST",
        success:function(response){

            if(response){
                alert('Report submitted successfully');
                location.href = document.referrer;
            }else{
                alert(response);
            }
            
            
        }
    });
});

$(document).ready(function(){

    if('<?=$financial_report_submitted?>' == 1){
        $("#bank_statement_balance").prop('disabled','disabled');
        $(".clear_btn").addClass('disabled');
        $(".delete_statement").removeClass('delete_statement');
    }

    $('#fund_balance_table tbody tr').each(function(i,el){
        let opening_balance = parseFloat($(el).find('.fund_month_opening_balance').html().split(',').join(""));
        let month_income = parseFloat($(el).find('.fund_month_income').html().split(',').join(""));
        let month_expense = parseFloat($(el).find('.fund_month_expense').html().split(',').join(""));
        let closing_opening_balance = (opening_balance + month_income) - month_expense; 
        
        $(this).find('.fund_month_closing_balance').html(accounting.formatNumber(closing_opening_balance,2));
    });

});

$("#frm_selected_offices").on('submit',function(ev){
    var url = $(this).attr('action');
    
    var data = $(this).serializeArray(); //{'project_ids':[1,2],'office_ids':[1,2],'transacting_month':'2020-04-01','report_id':'<?=$this->id;?>'};//

    $.post(url,data,function(response){
        //alert(response);
        $('#financial_report_row').html(response);
    });

    ev.preventDefault();
});

$("#bank_statement_balance").on('click',function(){
    //$(this).val(null);
});

$("#bank_statement_balance").on('change',function(){
    ///alert('Hello');
    var bank_statement_balance = $(this).val();
    var url = "<?=base_url();?>financial_report/update_bank_statement_balance";
    var reporting_month = "<?=$reporting_month;?>";
    var statement_date = $('#bank_statement_date').val();
    var book_closing_balance = '<?=$bank_reconciliation['book_closing_balance'];?>';
    var month_outstanding_cheques = '<?=$bank_reconciliation['month_outstanding_cheques'];?>';
    var month_transit_deposit = '<?=$bank_reconciliation['month_transit_deposit'];?>';
    var office_id = "<?=$office_ids[0];?>";

    var reconciled_balance = parseFloat(bank_statement_balance) - parseFloat(month_outstanding_cheques) + parseFloat(month_transit_deposit);

    $("#reconciled_bank_balance").html(reconciled_balance);

    var oldClass = "label-danger";
    var newClass = "label-success";
    var oldLabel = "Not Balanced";
    var newLabel = "Balanced";
 
    if(parseFloat(reconciled_balance) == parseFloat(book_closing_balance)){
        newClass = "label-success";newLabel = "Balanced";
    }else{
        newClass = "label-danger";newLabel = "Not Balanced";
    }
        
    $("#reconciliation_flag").removeClass(oldClass).addClass(newClass);
    $("#reconciliation_flag").html(newLabel);

    $.ajax({
        url:url,
        type:"POST",
        data:{'bank_statement_balance':bank_statement_balance,'reporting_month':reporting_month,'statement_date':statement_date,'office_id':office_id},
        success:function(response){
            alert(response);
        }
    });
});

$(document).on('click',".to_clear",function(){
    var btn = $(this);
    var id = $(this).attr('id');
    var url = "<?=base_url();?>financial_report/clear_transactions";
    var voucher_state = btn.hasClass('state_0')?0:1;//$(this).attr('data-state');
    var data = {'voucher_id':id,'is_outstanding_cheque':btn.hasClass('outstanding_cheque'),'voucher_state':voucher_state,'reporting_month':'<?=$reporting_month;?>'};
    var from_class = "active_effect";
    var to_class = "cleared_effect";
    var current_table = btn.closest('table');
    var connector_table =  current_table.attr('id')+"_connector";
    var from_color = 'danger';
    var to_color = 'success';
    var to_label = "<?=get_phrase('unclear');?>";

    if(btn.hasClass('cleared_effect')){
        from_class = 'cleared_effect';
        to_class = "active_effect";
        from_color = 'success';
        to_color = 'danger';
        to_label = "<?=get_phrase('clear');?>";
    }
    
    $.ajax({
        url:url,
        data:data,
        type:"POST",
        success:function(response){

            if(response){

                var cloned_tr = btn.closest('tr').clone();
            
                var action_div = cloned_tr.find(':first-child').find('div');
            
                btn.closest('tr').remove();
                        
                action_div.removeClass(from_class).removeClass('btn-'+from_color).addClass(to_class).addClass('btn-'+to_color).html(to_label);
                        
                $("."+connector_table+" tbody").append(cloned_tr);

            }else{
                alert('<?=get_phrase('update_failed');?>');
            }

        }
    });
});

// $("#drop_statements").dropzone({
//     url: "<?=base_url()?>financial_report/upload_statements",
// });


    var myDropzone = new Dropzone("#drop_statements", { 
        url: "<?=base_url()?>financial_report/upload_statements",
        paramName: "file", // The name that will be used to transfer the file
        params:{
            'office_id':<?=$office_ids[0];?>,
            'reporting_month':'<?=$reporting_month;?>'
        },
        maxFilesize: 5, // MB
        uploadMultiple:true,
        acceptedFiles:'image/*,application/pdf',    
    });

    // myDropzone.on("sending", function(file, xhr, formData) { 
    // // Will sendthe filesize along with the file as POST data.
    // formData.append("filesize", file.size);  

    // });

    myDropzone.on("complete", function(file) {
        //myDropzone.removeFile(file);
        myDropzone.removeAllFiles();
        //alert(myDropzone.getAcceptedFiles());
    }); 

    myDropzone.on("success", function(file,response) {
        //alert(response);
        if(response == 0){
            alert('Error in uploading files');
            return false;
        }
        var table_tbody = $("#tbl_list_statements tbody");
        var obj = JSON.parse(response);

        for (let i = 0; i < obj.file.name.length; i++) {
            table_tbody.append('<tr><td><a href="#" class="fa fa-trash-o delete_statement" id="uploads/attachments/financial_report/'+obj.financial_report_id+'/'+obj.file.name[i]+'"></a></td><td><a target="__blank" href="<?=base_url();?>uploads/attachments/financial_report/'+obj.financial_report_id+'/'+obj.file.name[i]+'">'+obj.file.name[i]+'</a></td><td>'+obj.file.size[i]+'</td><td><?=date('Y-m-d');?></td></tr>');
        }

    });  


    $(document).on('click','.delete_statement',function(){
 
        var file_path = $(this).attr('id');
        var url = "<?=base_url();?>financial_report/delete_statement";
        var data = {'path':file_path};

        $.ajax({
            url:url,
            data:data,
            type:"POST",
            success:function(response){
                alert(response);
                $(".delete_statement").closest('tr').remove();
            }
        });
        
    }); 

</script>