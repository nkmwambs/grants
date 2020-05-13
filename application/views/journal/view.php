<?php
//print_r($result['vouchers']);

extract($result);


$sum_of_accounts = count($accounts['income']) + count($accounts['expense']);

?>

<style>
    .align-right{
        text-align:right;
    }

</style>

<div class="row">
  <div class="col-xs-12">
      <?=Widget_base::load('comment');?>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
      <a href='<?=base_url();?>voucher/multi_form_add' class='btn btn-default'><?=get_phrase('add_voucher');?></a>
  </div>
</div>

<hr>

<div class='row'>
    <div class='col-xs-12' style='overflow-x: auto'>
        
        <table class='table table-bordered' style='white-space:nowrap;'>
            <thead>
                <tr>
                    <th>
                        <?php if($navigation['previous']){?>
                            <a class='pull-left' href="<?=base_url();?>Journal/view/<?=hash_id($navigation['previous']);?>" title='Previous Month'><i class='fa fa-minus-circle' style='font-size:20pt;'></i></a>
                        <?php }?>    
                    </th>
                    <th colspan="<?=$sum_of_accounts + 8 + (count($month_opening_balance['bank_balance']) * 3);?>" style='text-align:center;'>
                        <?=$office_name;?></br>
                        Cash Journal <br>
                        <?=date('F Y',strtotime($transacting_month));?>    

                    </th>
                    <th>
                        <?php if($navigation['next']){?>
                            <a class='pull-right' href="<?=base_url();?>Journal/view/<?=hash_id($navigation['next']);?>" title='Next Month'><i class='fa fa-plus-circle' style='font-size:20pt;'></i></a>
                        <?php }?>
                    </th>
                </tr>
                <tr>
                    <th colspan='7'></th>
                    
                    <?php foreach($month_opening_balance['bank_balance'] as $office_bank_id => $bank_account){?>
                        <th colspan='3' style='text-align:center;'>Bank (<?=$bank_account['account_name']?>)</th>
                    <?php }?>
                    
                    <th colspan='3' style='text-align:center;'>Cash</th>
                    <th colspan='<?=$sum_of_accounts;?>'></th>
                </tr>
                <tr>
                    <th colspan='7'>Balance b/f</th>
                    
                    <?php foreach($month_opening_balance['bank_balance'] as $office_bank_id => $bank_account){?>
                        <th colspan='3'><?=number_format($bank_account['amount'],2);?></th>
                    <?php }?>
                    
                    <th colspan='3'><?=number_format($month_opening_balance['cash_balance'],2);?></th>
                    <th colspan='<?=count($accounts['income']);?>'><?=get_phrase('income');?></th>
                    <th colspan='<?=count($accounts['expense']);?>'><?=get_phrase('expense');?></th>
                </tr>
                <tr>
                    <th></th>
                    <th><?=get_phrase('date');?></th>
                    <th><?=get_phrase('voucher_type');?></th>
                    <th><?=get_phrase('voucher_number');?></th>
                    <th><?=get_phrase('payee');?></th>
                    <th><?=get_phrase('description');?></th>
                    <th><?=get_phrase('cheque_number');?></th>
                    <?php foreach($month_opening_balance['bank_balance'] as $office_bank_id => $bank_account){?>
                        <th><?=get_phrase('bank_income');?></th>
                        <th><?=get_phrase('bank_expense');?></th>
                        <th><?=get_phrase('bank_balance');?></th>
                    <?php }?>
                    <th><?=get_phrase('cash_income');?></th>
                    <th><?=get_phrase('cash_expense');?></th>
                    <th><?=get_phrase('cash_balance');?></th>
                    
                    <?php foreach($accounts['income'] as $income_account_code){ ?>
                        <th><?=$income_account_code;?></th>
                    <?php }?>

                    <?php foreach($accounts['expense'] as $expense_account_code){?>   
                        <th><?=$expense_account_code;?></th>
                    <?php }?>  
                    
                </tr>
            </thead>

            <tbody>
                <?php 
                
                $bank_accounts = array_flip(array_keys($month_opening_balance['bank_balance']));
                
                $running_bank_balance = $bank_accounts;
                $sum_bank_income = $bank_accounts;
                $sum_bank_expense = $bank_accounts;

                $running_petty_cash_balance = 0;
                $sum_petty_cash_income = 0;
                $sum_petty_cash_expense = 0;

                foreach($vouchers as $voucher_id => $voucher){
                 extract($voucher);
                ?>
                     <tr>
                        <td>
                            <!-- <a href="#" class="action" title="Approve"><i class='fa fa-check'></i></a> 
                            <a href="#" class="action" title="Decline"><i class='fa fa-times'></i></a>
                            <a href="#" class="action" title="Clear"><i class='fa fa-eraser'></i></a> -->
                            <div class="btn btn-danger"><?=get_phrase('clear');?></div>
                        </td>
                        <td><?=date('jS M Y',strtotime($date));?></td>
                        <td><span title="<?=$voucher_type_name;?>" class="label <?=$cleared?'btn-success':'btn-warning';?>"><?=$this->config->item('use_voucher_type_abbreviation')?$voucher_type_abbrev:$voucher_type_name;?><span></td>
                        <td>
                            <a href="<?=base_url();?>voucher/view/<?=hash_id($voucher_id);?>" target="__blank">
                                <div class='btn btn-default'><?=$voucher_number;?></div>
                            </a>    
                        </td>

                        <td 
                            title='<?php if(strlen($payee)>50) echo $description;?>'
                        >
                            <?=strlen($payee)>50?substr($payee,0,50).'...':$payee;?>
                        </td>
                        
                        <td 
                            title='<?php if(strlen($description)>50) echo $description;?>'
                        >
                            <?=strlen($description)>50?substr($description,0,50).'...':$description;?>
                        </td>

                        <td class='align-right'><?=$cheque_number != 0?$cheque_number:'';?></td>
                        
                        <?php 
                            $voucher_amount = array_sum(array_column($spread,'transacted_amount'));

                            if($office_bank_id){
                                $bank_income[$office_bank_id] = (($voucher_type_cash_account == 'bank' && $voucher_type_transaction_effect == 'income') || ($voucher_type_cash_account=='bank' && $voucher_type_transaction_effect == 'contra'))?$voucher_amount:0;
                                $bank_expense[$office_bank_id] = (($voucher_type_cash_account == 'bank' && $voucher_type_transaction_effect == 'expense') || ($voucher_type_cash_account == 'cash' && $voucher_type_transaction_effect == 'contra'))?$voucher_amount:0;
                                
                                $sum_bank_income[$office_bank_id] = $sum_bank_income[$office_bank_id] + $bank_income[$office_bank_id];
                                $sum_bank_expense[$office_bank_id] = $sum_bank_expense[$office_bank_id] + $bank_expense[$office_bank_id];
                            
                                $running_bank_balance[$office_bank_id] = $month_opening_balance['bank_balance'][$office_bank_id]['amount'] + ($sum_bank_income[$office_bank_id] - $sum_bank_expense[$office_bank_id]);
                            }

                            $petty_cash_income = (($voucher_type_cash_account == 'cash' && $voucher_type_transaction_effect == 'income') || ($voucher_type_cash_account=='cash' && $voucher_type_transaction_effect == 'contra'))?$voucher_amount:0;
                            $petty_cash_expense = (($voucher_type_cash_account == 'cash' && $voucher_type_transaction_effect == 'expense') || ($voucher_type_cash_account == 'bank' && $voucher_type_transaction_effect == 'contra'))?$voucher_amount:0;

                            $sum_petty_cash_income += $petty_cash_income;
                            $sum_petty_cash_expense += $petty_cash_expense;
                            $running_petty_cash_balance = 0;//$month_opening_balance['cash'] + ($sum_petty_cash_income - $sum_petty_cash_expense);
                       ?>
                        
                        <?php foreach($month_opening_balance['bank_balance'] as $bank_id => $bank_account){?>
                            <td class='align-right'><?=number_format($bank_id == $office_bank_id?$bank_income[$bank_id]:0,2);?></td>
                            <td class='align-right'><?=number_format($bank_id == $office_bank_id?$bank_expense[$bank_id]:0,2);?></td>
                            <td class='align-right'><?=number_format($bank_id == $office_bank_id?$running_bank_balance[$bank_id]:0,2);?></td>
                        <?php }?>

                        <td class='align-right'><?=number_format($petty_cash_income,2);?></td>
                        <td class='align-right'><?=number_format($petty_cash_expense,2);?></td>
                        <td class='align-right'><?=number_format($running_petty_cash_balance,2);?></td>

                        <?php 
                            echo $this->journal_library->journal_spread($spread,$voucher_type_cash_account,$voucher_type_transaction_effect);
                        ?>

                     </tr>   
                <?php }?>
               
            </tbody>
            <tfoot>
                  <tr>
                    <td colspan='7'><?=get_phrase('total_and_balance_b/d');?></td>
                    <?php foreach($month_opening_balance['bank_balance'] as $office_bank_id => $bank_account){?>
                        <td class='align-right'><?=number_format($sum_bank_income[$office_bank_id],2);?></td>
                        <td class='align-right'><?=number_format($sum_bank_expense[$office_bank_id],2);?></td>
                        <td class='align-right'><?=number_format($running_bank_balance[$office_bank_id],2);?></td>
                    <?php }?>

                    <td class='align-right'><?=number_format($sum_petty_cash_income,2);?></td>
                    <td class='align-right'><?=number_format($sum_petty_cash_expense,2);?></td>
                    <td class='align-right'><?=number_format($running_petty_cash_balance,2);?></td>

                    <!-- Spread totals -->
                    <?php foreach($accounts['income'] as $income_account_id=>$income_account_code){?>
                        <td class='total_income total_income_<?=$income_account_id;?>'>0</td>
                    <?php }?>

                    <?php foreach($accounts['expense'] as $expense_account_id=>$expense_account_code){?>
                        <td class='total_expense total_expense_<?=$expense_account_id;?>'>0</td>
                    <?php }?>

                  </tr>  
            </tfoot>
        </table>
    </div>
</div>

<script>

$(document).ready(function(){
    var income_account_ids = JSON.parse("<?=json_encode(array_keys($result['accounts']['income']));?>");
    var expense_account_ids = JSON.parse("<?=json_encode(array_keys($result['accounts']['expense']));?>");
    
    //alert(income_account_ids.length);
    
    $.each(income_account_ids,function(index,elem){

        var spread_income = $(".spread_income_"+elem);
        var sum = 0;
        $.each(spread_income,function(idx,el){
            sum += parseFloat($(el).html().replace(',',""));
        });
        $(".total_income_"+elem).html(accounting.formatNumber(sum,2));
    });

    $.each(expense_account_ids,function(index,elem){
        var spread_expense = $(".spread_expense_"+elem);
        var sum = 0;
        $.each(spread_expense,function(idx,el){
            sum += parseFloat($(el).html().replace(',',""));
        });
        $(".total_expense_"+elem).html(accounting.formatNumber(sum,2));
    });
    
});


$('.table').DataTable({
        dom: 'Bfrtip',
        //fixedHeader: true,
        "paging":   false,
        stateSave: true,
        bSort:false,
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
                text:'<?=get_phrase('export_in_pdf');?>',
                orientation: 'landscape',
                exportOptions:{
                    columns: 'th:not(:first-child)'
                }
            }
        ],
        "pagingType": "full_numbers"
      });

      $(".action").click(function(){

          var cnfrm = confirm('Are you sure you want to perform this action?');

          if(cnfrm){
            alert('Action performed successfully');
          }else{
            alert('Process aborted');
          }
      });
</script>