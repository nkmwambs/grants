<?php
    //print_r($month_opening_balance['bank_balance']);
    extract($result);
    $sum_of_accounts = count($accounts['income']) + count($accounts['expense']);
?>

<?php if(isset($office_bank_name)){?>
<div class='row'>
    <div class='col-xs-12' style='font-weight:bold;text-align:center;'>
        <?=get_phrase('office_bank_cash_journal');?> : <?=$office_bank_name;?>
    </div>
</div>
<?php }?>

<hr/>

<div class='row'>
    <div class='col-xs-12'>
    <table class='table table-bordered' style='white-space:nowrap;'>
            <thead>
                <tr>
                    <th>
                        <?php if($navigation['previous']){?>
                            <a class='pull-left' href="<?=base_url();?>Journal/view/<?=hash_id($navigation['previous']);?>" title='Previous Month'><i class='fa fa-minus-circle' style='font-size:20pt;'></i></a>
                        <?php }?>    
                    </th>
                    <th colspan="<?=$sum_of_accounts + 5 + (count($month_opening_balance['bank_balance']) * 3) + (count($month_opening_balance['cash_balance']) * 3);?>" style='text-align:center;'>
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

                    <?php foreach($month_opening_balance['cash_balance'] as $office_cash_id => $cash_account){?>
                        <th colspan='3' style='text-align:center;'>Cash (<?=$cash_account['account_name']?>)</th>
                    <?php }?>
                    
                    <!-- <th colspan='3' style='text-align:center;'>Cash</th> -->
                    <th colspan='<?=$sum_of_accounts;?>'></th>
                </tr>
                <tr>
                    <th colspan='7'>Balance b/f</th>
                    
                    <?php foreach($month_opening_balance['bank_balance'] as $office_bank_id => $bank_account){?>
                        <th colspan='3'><?=number_format($bank_account['amount'],2);?></th>
                    <?php }?>

                    <?php foreach($month_opening_balance['cash_balance'] as $office_cash_id => $cash_account){?>
                        <th colspan='3'><?=number_format($cash_account['amount'],2);?></th>
                    <?php }?>
                    
                    <!-- <th colspan='3'><?=number_format(array_sum(array_column($month_opening_balance['cash_balance'],'amount')),2);?></th> -->
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

                    <?php foreach($month_opening_balance['cash_balance'] as $office_cash_id => $cash_account){?>
                        <th><?=get_phrase('cash_income');?></th>
                        <th><?=get_phrase('cash_expense');?></th>
                        <th><?=get_phrase('cash_balance');?></th>
                    <?php }?>

                    <!-- <th><?=get_phrase('cash_income');?></th>
                    <th><?=get_phrase('cash_expense');?></th>
                    <th><?=get_phrase('cash_balance');?></th> -->
                    
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
                $cash_accounts = array_flip(array_keys($month_opening_balance['cash_balance']));
                
                $running_bank_balance = $bank_accounts;
                $sum_bank_income = $bank_accounts;
                $sum_bank_expense = $bank_accounts;

                $running_petty_cash_balance = $cash_accounts;
                $sum_petty_cash_income = $cash_accounts;
                $sum_petty_cash_expense = $cash_accounts;
                //print_r($vouchers);
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

                            if($office_bank_id && isset($sum_bank_income[$office_bank_id])){
                                $bank_income[$office_bank_id] = (($voucher_type_cash_account == 'bank' && $voucher_type_transaction_effect == 'income') || ($voucher_type_cash_account=='bank' && $voucher_type_transaction_effect == 'contra'))?$voucher_amount:0;
                                $bank_expense[$office_bank_id] = (($voucher_type_cash_account == 'bank' && $voucher_type_transaction_effect == 'expense') || ($voucher_type_cash_account == 'cash' && $voucher_type_transaction_effect == 'contra'))?$voucher_amount:0;
                                
                                $sum_bank_income[$office_bank_id] = $sum_bank_income[$office_bank_id] + $bank_income[$office_bank_id];
                                $sum_bank_expense[$office_bank_id] = $sum_bank_expense[$office_bank_id] + $bank_expense[$office_bank_id];
                            
                                $running_bank_balance[$office_bank_id] = $month_opening_balance['bank_balance'][$office_bank_id]['amount'] + ($sum_bank_income[$office_bank_id] - $sum_bank_expense[$office_bank_id]);
                            }

                            if($office_cash_id && isset($sum_petty_cash_income[$office_cash_id])){
                                $cash_income[$office_cash_id] = (($voucher_type_cash_account == 'cash' && $voucher_type_transaction_effect == 'income') || ($voucher_type_cash_account=='cash' && $voucher_type_transaction_effect == 'contra'))?$voucher_amount:0;
                                $cash_expense[$office_cash_id] = (($voucher_type_cash_account == 'cash' && $voucher_type_transaction_effect == 'expense') || ($voucher_type_cash_account == 'bank' && $voucher_type_transaction_effect == 'contra'))?$voucher_amount:0;
                                
                                $sum_petty_cash_income[$office_cash_id] = $sum_petty_cash_income[$office_cash_id] + $cash_income[$office_cash_id];
                                $sum_petty_cash_expense[$office_cash_id] = $sum_petty_cash_expense[$office_cash_id] + $cash_expense[$office_cash_id];
                            
                                $running_petty_cash_balance[$office_cash_id] = $month_opening_balance['cash_balance'][$office_cash_id]['amount'] + ($sum_petty_cash_income[$office_cash_id] - $sum_petty_cash_expense[$office_cash_id]);
                            }

                       ?>
                        
                        <?php foreach($month_opening_balance['bank_balance'] as $bank_id => $bank_account){?>
                            <td class='align-right'><?=number_format($bank_id == $office_bank_id?$bank_income[$bank_id]:0,2);?></td>
                            <td class='align-right'><?=number_format($bank_id == $office_bank_id?$bank_expense[$bank_id]:0,2);?></td>
                            <td class='align-right'><?=number_format($bank_id == $office_bank_id?$running_bank_balance[$bank_id]:0,2);?></td>
                        <?php }?>

                        <?php foreach($month_opening_balance['cash_balance'] as $cash_id => $cash_account){?>
                            <td class='align-right'><?=number_format($cash_id == $office_cash_id?$cash_income[$cash_id]:0,2);?></td>
                            <td class='align-right'><?=number_format($cash_id == $office_cash_id?$cash_expense[$cash_id]:0,2);?></td>
                            <td class='align-right'><?=number_format($cash_id == $office_cash_id?$running_petty_cash_balance[$cash_id]:0,2);?></td>
                        <?php }?>

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
                    
                    <?php foreach($month_opening_balance['cash_balance'] as $office_cash_id => $cash_account){?>
                        <td class='align-right'><?=number_format($sum_petty_cash_income[$office_cash_id],2);?></td>
                        <td class='align-right'><?=number_format($sum_petty_cash_expense[$office_cash_id],2);?></td>
                        <td class='align-right'><?=number_format($running_petty_cash_balance[$office_cash_id],2);?></td>
                    <?php }?>

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
</script>