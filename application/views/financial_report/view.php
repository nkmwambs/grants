<?php
print_r($result);
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

<div class="row">
  <div class="col-xs-12">
      <?=Widget_base::load('comment');?>
  </div>
</div>

<div class="row">
    <div class="col-xs-12 header">
        <?=get_phrase('office');?>: <?=$additional_information['office_name'];?> </br>
        <?=get_phrase('month');?>: <?=date('F Y',strtotime($additional_information['financial_report_month']));?> 
    </div>
</div>

<div class="row">
    <div class='col-xs-12 header'><?=get_phrase('fund_balance_report');?></div>
    <div class="col-xs-12">
        <table class="table table-striped" id="fund_balance_table">
        <thead>
            <tr>
                <th><?=get_phrase('fund');?></th>
                <th><?=get_phrase('opening_balance');?></th>
                <th><?=get_phrase('month_income');?></th>
                <th><?=get_phrase('month_expense');?></th>
                <th><?=get_phrase('closing_balance');?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($fund_balance_report as $fund_account_info){?>
                <tr>
                    <td><?=$fund_account_info['account_name'];?></td>
                    <td class="currency fund_month_opening_balance"><?=number_format($fund_account_info['month_opening_balance'],2);?></td>
                    <td class="currency fund_month_income"><?=number_format($fund_account_info['month_income'],2);?></td>
                    <td class="currency fund_month_expense"><?=number_format($fund_account_info['month_expense'],2);?></td>
                    <td class="currency fund_month_closing_balance">0.00</td>
                </tr>
            <?php }?>
        </tbody>
        <tfoot>
            <tr>
                <td>Total</td>
                <td id="total_fund_month_opening_balance">0.00</td>
                <td id="total_fund_month_income">0.00</td>
                <td id="total_fund_month_expense">0.00</td>
                <td id="total_fund_month_closing_balance">0.00</td>
            </tr>
        </tfoot>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-xs-6">
    <div class="col-xs-12 header"><?=get_phrase('proof_of_cash');?></div>

    <table class="table table-striped">
        <thead>
        </thead>
        <tbody>
            <tr>
                <td><?=get_phrase('cash_at_bank');?></td>
                <td>2,545,768.87</td>
            </tr>
            <tr>
                <td><?=get_phrase('cash_at_hand');?></td>
                <td>7,659.00</td>
            </tr>
            <tr>
                <td><?=get_phrase('total_cash');?></td>
                <td>2,553,427.87</td>
            </tr>
        </tbody>
    </table>
    </div>

    <div class="col-xs-6">
    <div class="col-xs-12 header"><?=get_phrase('financial_ratios');?></div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th><?=get_phrase('operating_ratio');?></th>
                <th><?=get_phrase('accumulated_fund_ratio');?></th>
                <th><?=get_phrase('budget_variance');?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>26%</td>
                <td>1.3</td>
                <td>18%</td>
            </tr>
        </tbody>
    </table>
    </div>

</div>

<div class="row">
    <div class="col-xs-6">
    <div class="col-xs-12 header"><?=get_phrase('bank_reconciliation');?></div>
        <table class="table table-striped">
            <thead>
            </thead>
            <tbody>
                <tr>
                    <td><?=get_phrase('bank_statement_date');?></td>
                    <td>30th November 2019</td>
                </tr>
                <tr>
                    <td><?=get_phrase('bank_statement_closing_balance');?></td>
                    <td><input type="text" class="form-control" value="2,702,668.87"/></td>
                </tr>
                <tr>
                    <td><?=get_phrase('book_closing_balance');?></td>
                    <td>2,545,768.87</td>
                </tr>
                <tr>
                    <td><?=get_phrase('oustanding_cheques');?></td>
                    <td>165,400.00</td>
                </tr>
                <tr>
                    <td><?=get_phrase('deposit_in_transit');?></td>
                    <td>8,500.00</td>
                </tr>
                <tr>
                    <td><?=get_phrase('reconciled_balance_balance');?></td>
                    <td>2,702,668.87 <span class="label label-success"><?=get_phrase('balanced');?></span></td>
                </tr>
            </tbody>
        </table>    
    </div>

    <div class="col-xs-6">
        <div class="col-xs-12 header"><?=get_phrase('bank_statements');?></div>
        
        <div class="col-xs-12" style="margin-bottom:20px;">
            <input class="form-control" type="file" multiple="multiple" placeholder="<?=get_phrase('upload_bank_statement_here');?>"/>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?=get_phrase('action');?></th>
                    <th><?=get_phrase('file_name');?></th>
                    <th><?=get_phrase('file_size');?></th>
                    <th><?=get_phrase('upload_date');?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="#" class="fa fa-trash-o"></a></td>
                    <td>Page 1</td>
                    <td>2.0 MB</td>
                    <td>30th November 2019</td>
                </tr>
                <tr>
                    <td><a href="#" class="fa fa-trash-o"></a></td>
                    <td>Page 2</td>
                    <td>2.3 MB</td>
                    <td>30th November 2019</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-xs-6">
    <div class="col-xs-12 header"><?=get_phrase('outstanding_cheques');?></div>
    
    <table class="table table-striped">
           <thead>
                <tr>
                    <th><?=get_phrase('action');?></th>
                    <th><?=get_phrase('date');?></th>
                    <th><?=get_phrase('description');?></th>
                    <th><?=get_phrase('cheque_number');?></th>
                    <th><?=get_phrase('amount');?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><div class="btn btn-success"><?=get_phrase('clear');?></div></td>
                    <td>15th May 2019</td>
                    <td>Training Cost</td>
                    <td>1120</td>
                    <td>35,000.00</td>
                </tr>
                <tr>
                    <td><div class="btn btn-success"><?=get_phrase('clear');?></div></td>
                    <td>20th November 2019</td>
                    <td>Facilitation Cost</td>
                    <td>2345</td>
                    <td>125,000.00</td>
                </tr>
                <tr>
                    <td><div class="btn btn-success"><?=get_phrase('clear');?></div></td>
                    <td>25th November 2019</td>
                    <td>PAYEE</td>
                    <td>2347</td>
                    <td>5,400.00</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"><?=get_phrase('total');?></td>
                    <td>165,400.00</td>
                </tr>
            </tfoot>
    </table>
    
    </div>

    <div class="col-xs-6">
    <div class="col-xs-12 header"><?=get_phrase('outstanding_cheques_cleared_effects');?></div>
        <table class="table table-striped">
           <thead>
                <tr>
                    <th><?=get_phrase('action');?></th>
                    <th><?=get_phrase('date');?></th>
                    <th><?=get_phrase('description');?></th>
                    <th><?=get_phrase('cheque_number');?></th>
                    <th><?=get_phrase('amount');?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><div class="btn btn-danger"><?=get_phrase('unclear');?></div></td>
                    <td>25th November 2019</td>
                    <td>Salaries</td>
                    <td>2311</td>
                    <td>345,000.00</td>
                </tr>
                <tr>
                    <td><div class="btn btn-danger"><?=get_phrase('unclear');?></div></td>
                    <td>20th November 2019</td>
                    <td>Stationary</td>
                    <td>2310</td>
                    <td>15,000.00</td>
                </tr>
    
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"><?=get_phrase('total');?></td>
                    <td>165,400.00</td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>


<div class="row">
    <div class="col-xs-6">
    <div class="col-xs-12 header"><?=get_phrase('deposit_in_transit');?></div>
    
    <table class="table table-striped">
           <thead>
                <tr>
                    <th><?=get_phrase('action');?></th>
                    <th><?=get_phrase('date');?></th>
                    <th><?=get_phrase('description');?></th>
                    <th><?=get_phrase('amount');?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><div class="btn btn-success"><?=get_phrase('clear');?></div></td>
                    <td>15th May 2019</td>
                    <td>Training Cost</td>
                    <td>35,000.00</td>
                </tr>
                <tr>
                    <td><div class="btn btn-success"><?=get_phrase('clear');?></div></td>
                    <td>20th November 2019</td>
                    <td>Facilitation Cost</td>
                    <td>125,000.00</td>
                </tr>
                <tr>
                    <td><div class="btn btn-success"><?=get_phrase('clear');?></div></td>
                    <td>25th November 2019</td>
                    <td>PAYEE</td>
                    <td>5,400.00</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><?=get_phrase('total');?></td>
                    <td>165,400.00</td>
                </tr>
            </tfoot>
    </table>
    
    </div>

    <div class="col-xs-6">
    <div class="col-xs-12 header"><?=get_phrase('deposit_in_transit_cleared_effects');?></div>
        <table class="table table-striped">
           <thead>
                <tr>
                    <th><?=get_phrase('action');?></th>
                    <th><?=get_phrase('date');?></th>
                    <th><?=get_phrase('description');?></th>
                    <th><?=get_phrase('amount');?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><div class="btn btn-danger"><?=get_phrase('unclear');?></div></td>
                    <td>25th November 2019</td>
                    <td>Salaries</td>
                    <td>345,000.00</td>
                </tr>
                <tr>
                    <td><div class="btn btn-danger"><?=get_phrase('unclear');?></div></td>
                    <td>20th November 2019</td>
                    <td>Stationary</td>
                    <td>15,000.00</td>
                </tr>
    
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><?=get_phrase('total');?></td>
                    <td>165,400.00</td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>

<div class="row">
    <div class="col-xs-12">
    <div class="col-xs-12 header"><?=get_phrase('expense_report');?></div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th><?=get_phrase('expense_account');?></th>
                <th><?=get_phrase('month_expense');?></th>
                <th><?=get_phrase('year_to_date_expense');?></th>
                <th><?=get_phrase('budget_to_date');?></th>
                <th><?=get_phrase('budget_variance');?></th>
                <th><?=get_phrase('percent_variance');?></th>
                <th><?=get_phrase('comment');?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Expense Account 1</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Expense Account 2</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Expense Account 2</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Expense Account 3</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>Total</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>0.00</td>
            </tr>
        </tfoot>
    </table>
    </div>
</div>

<script>

$(document).ready(function(){

    $('#fund_balance_table tbody tr').each(function(i,el){
        let opening_balance = parseFloat($(el).find('.fund_month_opening_balance').html().split(',').join(""));
        let month_income = parseFloat($(el).find('.fund_month_income').html().split(',').join(""));
        let month_expense = parseFloat($(el).find('.fund_month_expense').html().split(',').join(""));
        let closing_opening_balance = (opening_balance + month_income) - month_expense; 
        
        $(this).find('.fund_month_closing_balance').html(closing_opening_balance);
    });

});



</script>