<?php

extract($result);

//print_r($outstanding_cheques);

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
        <form id='frm_selected_offices' action='<?=base_url().ltrim($_SERVER['REQUEST_URI'],'/grants');?>' method='POST'>
            <div class='form-group'>
                <label class='col-xs-2 control-label'><?=get_phrase('choose_offices');?></label>
                
                <div class='col-xs-8'>
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

                <div class='col-xs-2'>
                     <i class='badge badge-info'><?=count($offices);?></i>               
                    <button type='submit' id='merge_reports' class='btn btn-default'><?=get_phrase('run');?></button>
                </div>
            </div>
        </form>
    </div>
</div>

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

    <div class="col-xs-6">
    <div class="col-xs-12 header"><?=get_phrase('financial_ratios');?></div>
        <?php include "includes/include_financial_ratios.php";?>
    </div>

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

<script>

$(document).ready(function(){

    $('#fund_balance_table tbody tr').each(function(i,el){
        let opening_balance = parseFloat($(el).find('.fund_month_opening_balance').html().split(',').join(""));
        let month_income = parseFloat($(el).find('.fund_month_income').html().split(',').join(""));
        let month_expense = parseFloat($(el).find('.fund_month_expense').html().split(',').join(""));
        let closing_opening_balance = (opening_balance + month_income) - month_expense; 
        
        $(this).find('.fund_month_closing_balance').html(accounting.formatNumber(closing_opening_balance,2));
    });

});

// $("#merge_reports").on('click',function(){
//     //alert('Hello');
//     var selected_offices = $("#selected_offices").text();
    

//     var url = "<?=base_url();?>financial_report/merge_financial_report";

//     $.ajax({
//         url:url,
//         data:$("#frm_selected_offices").serializeArray(),
//         type:"POST",
//         success:function(response){
//             alert(response);
//             $("#office_names").html('A combined report of:<br/> ' + selected_offices);
//         }
//     });
// });

$("#bank_statement_balance").on('click',function(){
    $(this).val(null);
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

$(".to_clear").on('click',function(){
    var btn = $(this);
    var id = $(this).attr('id');
    var url = "<?=base_url();?>financial_report/clear_transactions";
    var voucher_state = btn.hasClass('state_0')?0:1;//$(this).attr('data-state');
    var data = {'voucher_id':id,'is_outstanding_cheque':$(this).hasClass('outstanding_cheque'),'voucher_state':voucher_state,'reporting_month':'<?=$reporting_month;?>'};

    $.ajax({
        url:url,
        data:data,
        type:"POST",
        success:function(response){
            //alert(voucher_state);

            if(response == 1){
                if(btn.hasClass('state_0')){
                    btn.removeClass('btn-danger').removeClass('state_0').addClass('state_1').addClass('btn-success');
                    btn.html('<?=get_phrase('unclear');?>');

                }else if(btn.hasClass('state_1')){
                    btn.removeClass('btn-success').removeClass('state_1').addClass('state_0').addClass('btn-danger');
                    btn.html('<?=get_phrase('clear');?>');

                }

                var cloned_tr = btn.closest('tr').clone();
                    btn.closest('tr').remove();

                    if(btn.hasClass('outstanding_cheque')){
                        $("#tbl_cleared_outstanding_cheques tbody").append(cloned_tr);
                    }else{
                        $("#tbl_outstanding_cheques tbody").append(cloned_tr);
                    }

                    if(btn.hasClass('deposit_in_transit')){
                        $("#tbl_cleared_transit_deposit tbody").append(cloned_tr);
                    }else{
                        $("#tbl_transit_deposit tbody").append(cloned_tr);
                    }

            }else{
                alert('<?=get_phrase('update_failed');?>');
            }

            
        }
    });
});

</script>

