<?php 
print_r($result['test']);
?>
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

<hr/>
<?php if(!$multiple_offices_report && !$financial_report_submitted){?>
    <div class="row">
        <div class="col-xs-12" style="text-align:center;">
            <div class='btn btn-default' id="submit_report"><?=get_phrase('submit');?></div>
        </div>
    </div>    
<?php }?>
