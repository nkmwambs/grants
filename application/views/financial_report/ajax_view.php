<?php 
//print_r($result['fund_balance_report']);
//print_r($this->financial_report_model->_initial_opening_account_balance([1],3,[]));
//print_r($this->financial_report_model->income_accounts([1],[]));
//print_r($fund_balance_report);
//print_r($expense_report);
?>
<div class="row">
    <div class='col-xs-12 header'><?=get_phrase('fund_balance_report');?></div>
    <div class="col-xs-12">
        <?php include "includes/include_fund_balance_report.php";?>
    </div>
</div>

<!-- <div class='row'>
    <div class='col-xs-12 header'><?=get_phrase('projects_balance_report');?></div>
    <div class='col-xs-12'>
        <?php //include "includes/include_project_balance_report.php";?>
    </div>
</div> -->

<div class="row">
    <div class="col-xs-6">
    <div class="col-xs-12 header"><?=get_phrase('proof_of_cash');?></div>
        <?php include "includes/include_proof_of_cash.php";?>
    </div>

    <div class="col-xs-6">
    <div class="col-xs-12 header"><?=get_phrase('financial_ratios');?></div>
        <?php //include "includes/include_financial_ratios.php";?>
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

<hr/>
<?php if(!$multiple_offices_report && !$financial_report_submitted){?>
    <div class="row">
        <div class="col-xs-12" style="text-align:center;">
            <div class='btn btn-default' id="submit_report"><?=get_phrase('submit');?></div>
        </div>
    </div>    
<?php }?>

<script>
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

let sum_opening_balance = parseFloat($('#total_fund_month_opening_balance').html().split(',').join(""));
let sum_month_income = parseFloat($('#total_fund_month_income').html().split(',').join(""));
let sum_month_expense = parseFloat($('#total_fund_month_expense').html().split(',').join(""));

$("#total_fund_month_closing_balance").html(accounting.formatNumber((sum_opening_balance + sum_month_income - sum_month_expense),2));

$(".row_total, .row_header").css('font-weight','bold');

});
</script>
