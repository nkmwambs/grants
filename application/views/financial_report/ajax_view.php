<?php 
//print_r($this->financial_report_model->bugdet_to_date_by_expense_account([6],'2020-08-01'));
//print_r($this->financial_report_model->get_office_bank_project_allocation(1));

?>
<div id="voucher_print">
    <div class="row">
        <div class='col-xs-12 header'><?=get_phrase('fund_balance_report');?></div>
        <div class="col-xs-12">
            <?php include "includes/include_fund_balance_report.php";?>
        </div>
    </div>

    <div class='row'>
        <div class='col-xs-12 header'><?=get_phrase('projects_balance_report');?></div>
        <div class='col-xs-12'>
            <?php include "includes/include_project_balance_report.php";?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
        <div class="col-xs-12 header"><?=get_phrase('proof_of_cash');?></div>
            <?php include "includes/include_proof_of_cash.php";?>
        </div>

    <!--     <div class="col-xs-6">
        <div class="col-xs-12 header">
        <?php //echo get_phrase('financial_ratios');?>
        </div>
            <?php //include "includes/include_financial_ratios.php";?>
        </div>-->

    </div>

    <div class="row">
        <div class="col-xs-6">
        <div class="col-xs-12 header"><?=get_phrase('bank_reconciliation');?></div>
            <?php include "includes/include_bank_reconciliation.php";?>    
        </div>

        <div class="col-xs-6">
            <div class="col-xs-12 header"><?=get_phrase('bank_statements');?></div>
            <?php include "includes/include_bank_statements.php";?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
        <div class="col-xs-12 header"><?=get_phrase('outstanding_cheques');?></div>
            <?php include "includes/include_outstanding_cheques.php";?>
        </div>

        <div class="col-xs-6">
        <div class="col-xs-12 header"><?=get_phrase('outstanding_cheques_cleared_effects');?></div>
            <?php include "includes/include_cleared_outstanding_cheques.php";?>
        </div>

    </div>


    <div class="row">
        <div class="col-xs-6">
        <div class="col-xs-12 header"><?=get_phrase('deposit_in_transit');?></div>
            <?php include "includes/include_deposit_in_transit.php";?>
        </div>

        <div class="col-xs-6">
        <div class="col-xs-12 header"><?=get_phrase('deposit_in_transit_cleared_effects');?></div>
            <?php include "includes/include_cleared_deposit_in_transit.php";?>
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12">
        <div class="col-xs-12 header"><?=get_phrase('expense_report');?></div>
            <?php include "includes/include_expense_report.php";?>
        </div>
    </div>

</div>

<hr/>
<?php //if(!$multiple_offices_report && $multiple_projects_report && !$financial_report_submitted) 
if(!$financial_report_submitted){
    ?>
    <div class="row">
        <div class="col-xs-12" style="text-align:center;">
            <div class='btn btn-default' id="submit_report"><?=get_phrase('submit');?></div>
        </div>
    </div>    
<?php }?>

<script>

$("#submit_report").on('click',function(ev){
    var url = "<?=base_url();?>Financial_report/submit_financial_report";
    var data = {'office_id':<?=$office_ids[0];?>,'reporting_month':'<?=$reporting_month;?>'};
    
    $.post(url,data,function(response){
        if(response){
            if(response != 1){
                alert(response);
            }else{
                alert('MFR Submitted Successful');
                location.href = document.referrer;
            }
                
            }else{
                alert(response);
            }
    });

    ev.preventDefault();
});

$(document).ready(function(){

    // $(".total_oc").append(" <span class='label label-success'>2</span>");
    // $(".total_dt").append(" <span class='label label-danger'>3</span>");
    // $(".code_proof_of_cash").append(" <span class='label label-info'>1</span>");
    

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

let sum_opening_balance = parseFloat($('#total_fund_month_opening_balance').html().split(',').join(""));
let sum_month_income = parseFloat($('#total_fund_month_income').html().split(',').join(""));
let sum_month_expense = parseFloat($('#total_fund_month_expense').html().split(',').join(""));

$("#total_fund_month_closing_balance").html(accounting.formatNumber((sum_opening_balance + sum_month_income - sum_month_expense),2));
// $("#total_fund_month_closing_balance").append(" <span class='label label-info'>1</span>");
$(".row_total, .row_header").css('font-weight','bold');

});


function compute_reconciliation(clear_btn){
    var td_effects_total = clear_btn.closest('table').find('td.td_effects_total');
    var td_row_amount = clear_btn.closest('tr').find('td.td_row_amount');
    var table_id = clear_btn.closest('table').attr('id');

    var drop_table_id = '';
    var effect_to_balance = 'negative';

    if(table_id == 'tbl_transit_deposit'){

        drop_table_id = 'tbl_cleared_transit_deposit';

    }else if(table_id == 'tbl_cleared_transit_deposit'){

        drop_table_id = 'tbl_transit_deposit';
        effect_to_balance = 'positive';

    }else if(table_id == 'tbl_outstanding_cheque'){

        drop_table_id = 'tbl_cleared_outstanding_cheque';

    }else if(table_id == 'tbl_cleared_outstanding_cheque'){

        drop_table_id = 'tbl_outstanding_cheque';
        effect_to_balance = 'positive';

    }


    var effects_total = td_effects_total.html().split(',').join("");
    var row_amount = td_row_amount.html().split(',').join("");

    var td_drop_table_total = $("#"+drop_table_id).find('td.td_effects_total');
    var drop_table_total = td_drop_table_total.html().split(',').join("");

    var origin_table_balance = parseFloat(effects_total) - parseFloat(row_amount);
    var drop_table_balance = parseFloat(drop_table_total) + parseFloat(row_amount);

    td_effects_total.html(accounting.formatNumber(origin_table_balance,2));
    td_drop_table_total.html(accounting.formatNumber(drop_table_balance,2));

    //alert(drop_table_balance);

    var td_deposit_in_transit = $("#td_deposit_in_transit");
    var td_oustanding_cheques = $("#td_oustanding_cheques");
    var reconciled_bank_balance = $("#reconciled_bank_balance");

    if(table_id == 'tbl_transit_deposit'){
        td_deposit_in_transit.html(accounting.formatNumber(origin_table_balance,2));
    }else if(table_id == 'tbl_cleared_transit_deposit' ){
        td_deposit_in_transit.html(accounting.formatNumber(drop_table_balance,2));
    }else if(table_id == 'tbl_outstanding_cheque'){
        td_oustanding_cheques.html(accounting.formatNumber(origin_table_balance,2));
    }else if(table_id == 'tbl_cleared_outstanding_cheque' ){
        td_oustanding_cheques.html(accounting.formatNumber(drop_table_balance,2));
    }

    var td_bank_reconciliation_balance = $("#td_bank_reconciliation_balance"); 
    var bank_reconciliation_balance = 0;

    if(td_bank_reconciliation_balance.find('input').length > 0){
        bank_reconciliation_balance = td_bank_reconciliation_balance.find('input').val().split(',').join("");
    }else{
        bank_reconciliation_balance = td_bank_reconciliation_balance.html().split(',').join("");
    }
    
    var reconciled_bank_balance = parseFloat(bank_reconciliation_balance) + parseFloat(td_deposit_in_transit.html().split(',').join("")) - parseFloat(td_oustanding_cheques.html().split(',').join(""));

    $("#reconciled_bank_balance").html(accounting.formatNumber(reconciled_bank_balance,2));

    var td_book_closing_balance = $("#td_book_closing_balance");

    var book_closing_balance = td_book_closing_balance.html().split(',').join("");

    if(parseFloat(book_closing_balance) === parseFloat(reconciled_bank_balance)){
        if($("#reconciliation_flag").hasClass('label-danger')){
            $("#reconciliation_flag").removeClass('label-danger');
            $("#reconciliation_flag").addClass('label-success');
            $("#reconciliation_flag").html('<?=get_phrase('balanced');?>');
        }
    }else{
        if($("#reconciliation_flag").hasClass('label-success')){
            $("#reconciliation_flag").removeClass('label-success');
            $("#reconciliation_flag").addClass('label-danger');
            $("#reconciliation_flag").html('<?=get_phrase('not_balanced');?>');
        }
    }
}

function clear_effect(btn){
    // var btn = $(this);
    var id = btn.attr('id');
    var url = "<?=base_url();?>financial_report/clear_transactions";
    var voucher_state = btn.hasClass('state_0')?0:1;//$(this).attr('data-state');
    var opening_outstanding_cheque_id = btn.data('opening_outstanding_cheque_id');
    var opening_deposit_transit_id = btn.data('opening_deposit_transit_id');
    var data = {'voucher_id':id,'is_outstanding_cheque':btn.hasClass('outstanding_cheque'),'voucher_state':voucher_state,'reporting_month':'<?=$reporting_month;?>','opening_outstanding_cheque_id':opening_outstanding_cheque_id,'opening_deposit_transit_id':opening_deposit_transit_id};
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
            //console.log(response);
            if(response){

                var cloned_tr = btn.closest('tr').clone();
            
                var action_div = cloned_tr.find(':first-child').find('div');
            
                btn.closest('tr').remove();
                        
                action_div.removeClass(from_class).removeClass('btn-'+from_color).addClass(to_class).addClass('btn-'+to_color).html(to_label);
                
                if(action_div.hasClass('state_0')){
                    action_div.removeClass('state_0').addClass('state_1');
                }else{
                    action_div.removeClass('state_1').addClass('state_0');
                }

                $("."+connector_table+" tbody").append(cloned_tr);

            }else{
                alert('<?=get_phrase('update_failed');?>');
            }

        }
    });
}


$(document).on('click','.clear_btn',function(e){   
    //console.log('Firing!!!');
    compute_reconciliation($(this));
    clear_effect($(this));
    e.stopImmediatePropagation();
    //e.preventDefault();
});

    $(document).ready(function(){
        var total_cash = $("#total_cash").html().replace(',','');;
        var total_fund_month_closing_balance = $("#total_fund_month_closing_balance").html().replace(',','');

        var proof_check_message = '<span class="label label-danger">Incorrect Proof Of Cash</span>';

        if((parseFloat(total_cash) - parseFloat(total_fund_month_closing_balance)) == 0){
            proof_check_message = '<span class="label label-success">Correct Proof Of Cash</span>';
        }

        // $('.code_proof_of_cash').css('color','brown');
        // $('.code_proof_of_cash').css('font-weight','bold');

        $("#proof_of_cash_check").html(proof_check_message);
    });


 $(document).ready(function(){
    Dropzone.autoDiscover = false;
});

var myDropzone = new Dropzone("#drop_statements", { 
        url: "<?=base_url()?>financial_report/upload_statements",
        paramName: "file", // The name that will be used to transfer the file
        params:{
            'office_id':<?=$office_ids[0];?>,
            'reporting_month':'<?=$reporting_month;?>',
            'project_id': $("#project_ids").val()?$("#project_ids").val():'',
            'office_bank_ids':$("#office_bank_ids").val()?$("#office_bank_ids").val():''
        },
        maxFilesize: 50, // MB
        uploadMultiple:true,
        parallelUploads:5,
        maxFiles:5,
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

    myDropzone.on('error', function(file, response) {
       // $(file.previewElement).find('.dz-error-message').text(response);
       console.log(response);
    });

    myDropzone.on("success", function(file,response) {
        console.log(response);
        if(response == 0){
            alert('Error in uploading files');
            return false;
        }
        var table_tbody = $("#tbl_list_statements tbody");
        var obj = JSON.parse(response);

        $.each(obj,function(i,elem){
            table_tbody.append('<tr><td><a href="#" class="fa fa-trash-o delete_statement" id=""></a></td><td><a target="__blank" href="'+elem.s3_preassigned_url+'">'+elem.attachment_name+'</a></td><td>'+elem.attachment_size+'</td><td>'+elem.attachment_last_modified_date+'</td></tr>');
        });
        
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
