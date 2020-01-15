<?php
//print_r($this->journal_model->get_office_data_from_journal());
//print_r($result);

extract($result);

?>

<style>
    .align-right{
        text-align:right;
    }
</style>

<div class='row'>
    <div class='col-xs-12'>
        
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th><a class='pull-left' href="#"><i class='fa fa-angle-left' style='font-size:20pt;'></i></a></th>
                    <th colspan="10" style='text-align:center;'>
                        <?=$office_name;?></br>
                        Cash Journal <br>
                        <?=date('F Y',strtotime($transacting_month));?>    

                    </th>
                    <th><a class='pull-right' href="#"><i class='fa fa-angle-right' style='font-size:20pt;'></i></a></th>
                </tr>
                <tr>
                    <th colspan='6'></th>
                    <th colspan='3' style='text-align:center;'>Bank</th>
                    <th colspan='3' style='text-align:center;'>Cash</th>
                </tr>
                <tr>
                    <th colspan='6'>Balance b/f</th>
                    <th colspan='3'><?=number_format($month_opening_balance['bank'],2);?></th>
                    <th colspan='3'><?=number_format($month_opening_balance['cash'],2);?></th>
                </tr>
                <tr>
                    <th>Action</th>
                    <th>Date</th>
                    <th>Voucher Type</th>
                    <th>Voucher Number</th>
                    <th>Description</th>
                    <th>Cheque Number</th>
                    <th>Bank Income</th>
                    <th>Bank Expense</th>
                    <th>Bank Balance</th>
                    <th>Cash Income</th>
                    <th>Cash Expense</th>
                    <th>Cash Balance</th>
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
                            <a href="#" class="action" title="Approve"><i class='fa fa-check'></i></a> 
                            <a href="#" class="action" title="Decline"><i class='fa fa-times'></i></a>
                            <a href="#" class="action" title="Clear"><i class='fa fa-eraser'></i></a>
                        </td>
                        <td><?=date('jS M Y',strtotime($date));?></td>
                        <td><span class="label <?=$cleared?'btn-success':'btn-warning';?>"><?=$this->config->item('use_voucher_type_abbreviation')?$voucher_type_abbrev:$voucher_type_name;?><span></td>
                        <td>
                            <a href="<?=base_url();?>voucher/view/<?=hash_id($voucher_id);?>" target="__blank">
                                <div class='btn btn-default'><?=$voucher_number;?></div>
                            </a>    
                        </td>
                        <td><?=$description;?></td>
                        <td class='align-right'><?=$cheque_number != 0?$cheque_number:'';?></td>
                        
                        <?php 
                            $bank_income = ($voucher_type_cash_account == 'bank' && ($voucher_type_transaction_effect == 'income' || $voucher_type_transaction_effect == 'contra'))?$voucher_amount:0;
                            $bank_expense = (($voucher_type_cash_account == 'bank' && $voucher_type_transaction_effect == 'expense') || ($voucher_type_cash_account == 'cash' && $voucher_type_transaction_effect == 'contra'))?$voucher_amount:0;
                            $petty_cash_income = ($voucher_type_cash_account == 'cash' && ($voucher_type_transaction_effect == 'income' || $voucher_type_transaction_effect == 'contra'))?$voucher_amount:0;
                            $petty_cash_expense = (($voucher_type_cash_account == 'cash' && $voucher_type_transaction_effect == 'expense') || ($voucher_type_cash_account == 'bank' && $voucher_type_transaction_effect == 'contra'))?$voucher_amount:0;

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
                     </tr>   
                <?php }?>
               
            </tbody>
            <tfoot>
                  <tr>
                    <td colspan='6'>Total and Balance b/d</td>

                    <td class='align-right'><?=number_format($sum_bank_income,2);?></td>
                    <td class='align-right'><?=number_format($sum_bank_expense,2);?></td>
                    <td class='align-right'><?=number_format($running_bank_balance,2);?></td>

                    <td class='align-right'><?=number_format($sum_petty_cash_income,2);?></td>
                    <td class='align-right'><?=number_format($sum_petty_cash_expense,2);?></td>
                    <td class='align-right'><?=number_format($running_petty_cash_balance,2);?></td>

                  </tr>  
            </tfoot>
        </table>
    </div>
</div>

<script>
$('.table').DataTable({
        dom: 'Bfrtip',
        fixedHeader: true,
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