<?php
//print_r($this->journal_model->_voucher_max_status_id_where('2020-03-01'));

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
                    <th colspan="<?=$sum_of_accounts + 11;?>" style='text-align:center;'>
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
                    <th colspan='3' style='text-align:center;'>Bank</th>
                    <th colspan='3' style='text-align:center;'>Cash</th>
                    <th colspan='<?=$sum_of_accounts;?>'></th>
                </tr>
                <tr>
                    <th colspan='7'>Balance b/f</th>
                    <th colspan='3'><?=number_format($month_opening_balance['bank'],2);?></th>
                    <th colspan='3'><?=number_format($month_opening_balance['cash'],2);?></th>
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
                    <th><?=get_phrase('bank_income');?></th>
                    <th><?=get_phrase('bank_expense');?></th>
                    <th><?=get_phrase('bank_balance');?></th>
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
                $running_bank_balance = 0;
                $sum_bank_income = 0;
                $sum_bank_expense = 0;

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
                            $bank_income = (($voucher_type_cash_account == 'bank' && $voucher_type_transaction_effect == 'income') || ($voucher_type_cash_account=='bank' && $voucher_type_transaction_effect == 'cash_contra'))?$voucher_amount:0;
                            $bank_expense = (($voucher_type_cash_account == 'bank' && $voucher_type_transaction_effect == 'expense') || ($voucher_type_cash_account == 'cash' && $voucher_type_transaction_effect == 'bank_contra'))?$voucher_amount:0;
                            $petty_cash_income = (($voucher_type_cash_account == 'cash' && $voucher_type_transaction_effect == 'income') || ($voucher_type_cash_account=='cash' && $voucher_type_transaction_effect == 'bank_contra'))?$voucher_amount:0;
                            $petty_cash_expense = (($voucher_type_cash_account == 'cash' && $voucher_type_transaction_effect == 'expense') || ($voucher_type_cash_account == 'bank' && $voucher_type_transaction_effect == 'cash_contra'))?$voucher_amount:0;

                            $sum_bank_income += $bank_income;
                            $sum_bank_expense += $bank_expense;
                            $running_bank_balance = $month_opening_balance['bank'] + ($sum_bank_income - $sum_bank_expense);
                            
                            $sum_petty_cash_income += $petty_cash_income;
                            $sum_petty_cash_expense += $petty_cash_expense;
                            $running_petty_cash_balance = $month_opening_balance['cash'] + ($sum_petty_cash_income - $sum_petty_cash_expense);
                       ?>
                        
                        <td class='align-right'><?=number_format($bank_income,2);?></td>
                        <td class='align-right'><?=number_format($bank_expense,2);?></td>
                        <td class='align-right'><?=number_format($running_bank_balance,2);?></td>

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
                    <td colspan='7'>Total and Balance b/d</td>

                    <td class='align-right'><?=number_format($sum_bank_income,2);?></td>
                    <td class='align-right'><?=number_format($sum_bank_expense,2);?></td>
                    <td class='align-right'><?=number_format($running_bank_balance,2);?></td>

                    <td class='align-right'><?=number_format($sum_petty_cash_income,2);?></td>
                    <td class='align-right'><?=number_format($sum_petty_cash_expense,2);?></td>
                    <td class='align-right'><?=number_format($running_petty_cash_balance,2);?></td>

                    <?php for($i=0;$i<$sum_of_accounts;$i++){?>
                        <td>0</td> 
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