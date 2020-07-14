<style>
/* Style buttons */
.btn_reverse {
  background-color: DodgerBlue; /* Blue background */
  border: none; /* Remove borders */
  color: white; /* White text */
  padding: 12px 16px; /* Some padding */
  font-size: 16px; /* Set a font size */
  cursor: pointer; /* Mouse pointer on hover */
}

/* Darker background on mouse-over */
.btn_reverse:hover {
  background-color: RoyalBlue;
}

.edit_journal{
    cursor:pointer;
}
</style>

<?php
    //print_r($month_opening_balance['bank_balance']);
    extract($result);
    $sum_of_accounts = count($accounts['income']) + count($accounts['expense']);

    $role_has_journal_update_permission = $this->user_model->check_role_has_permissions(ucfirst($this->controller),'update');
    //$role_has_voucher_create_permission = $this->user_model->check_role_has_permissions(ucfirst('voucher'),'create');
    $check_if_financial_report_is_submitted = $this->financial_report_model->check_if_financial_report_is_submitted([$office_id],$transacting_month);
    //echo $check_if_financial_report_is_submitted;
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
                        <th colspan='3' style='text-align:center;'>Bank (<?=$bank_account['account_name'];?>)</th>
                    <?php }?>

                    <?php foreach($month_opening_balance['cash_balance'] as $office_cash_id => $cash_account){?>
                        <th colspan='3' style='text-align:center;'>Cash (<?=$cash_account['account_name'];?>)</th>
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
                        <th><?=get_phrase('bank_income').' ('.$bank_account['account_name'].')';?></th>
                        <th><?=get_phrase('bank_expense').' ('.$bank_account['account_name'].')';?></th>
                        <th><?=get_phrase('bank_balance').' ('.$bank_account['account_name'].')';?></th>
                    <?php }?>

                    <?php foreach($month_opening_balance['cash_balance'] as $office_cash_id => $cash_account){?>
                        <th><?=$cash_account['account_name'].' '.get_phrase('income');?></th>
                        <th><?=$cash_account['account_name'].' '.get_phrase('expense');?></th>
                        <th><?=$cash_account['account_name'].' '.get_phrase('balance');?></th>
                    <?php }?>
                    
                    
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
                // Create array of office_cash and office_bank ids keys with zero values
                $bank_accounts = array_map(function($elem){return 0;},array_flip(array_keys($month_opening_balance['bank_balance'])));
                $cash_accounts = array_map(function($elem){return 0;},array_flip(array_keys($month_opening_balance['cash_balance'])));
                
                // Imstantiate empty cash and bank balances
                $running_bank_balance = $bank_accounts;
                $sum_bank_income = $bank_accounts;
                $sum_bank_expense = $bank_accounts;

                $running_petty_cash_balance = $cash_accounts;
                $sum_petty_cash_income = $cash_accounts;
                $sum_petty_cash_expense = $cash_accounts;
                
                foreach($vouchers as $voucher_id => $voucher){
                 extract($voucher);
                ?>
                     <tr>
                        <td>
                            
                            <div data-voucher_id ='<?=$voucher_id;?>' class='btn btn_reverse <?=!$role_has_journal_update_permission?"disabled":''; ?> <?=$voucher_is_reversed?"hidden":"";?>' >
                                <i class='fa fa-undo' style='cursor:pointer;'></i>
                                <?=get_phrase('reverse');?>
                            </div>
                           
                            <!-- <div class="btn <?=!$cleared?'btn-danger':'btn-success';?> btn_action" ><?=get_phrase(!$cleared?'clear':'cleared');?></div> -->
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
                            <i data-voucher_id ='<?=$voucher_id;?>' data-reference_column = 'voucher_vendor' class='fa fa-pencil edit_journal  <?=(!$role_has_journal_update_permission || $voucher_is_reversed || $check_if_financial_report_is_submitted) ? 'hidden' : ''; ?> '></i> 
                                <span class='cell_content'><?=strlen($payee)>50?substr($payee,0,50).'...':$payee;?></span>
                        </td>
                        
                        <td 
                            title='<?php if(strlen($description)>50) echo $description;?>'
                        >
                            <i data-voucher_id ='<?=$voucher_id;?>' data-reference_column = 'voucher_description' class='fa fa-pencil edit_journal  <?=(!$role_has_journal_update_permission || $voucher_is_reversed || $check_if_financial_report_is_submitted ) ? 'hidden' : ''; ?> '></i> 
                            <span class='cell_content'><?=strlen($description)>50?substr($description,0,50).'...':$description;?></span>
                        </td>

                        <td class='align-right'><?=$cheque_number != 0?$cheque_number:'';?></td>
                        
                        <?php 

                            // Compute bank and cash running balances
                            $voucher_amount = array_sum(array_column($spread,'transacted_amount'));

                            if($office_bank_id && isset($sum_bank_income[$office_bank_id])){
                                $bank_income[$office_bank_id] = (($voucher_type_cash_account == 'bank' && $voucher_type_transaction_effect == 'income') || ($voucher_type_cash_account=='cash' && $voucher_type_transaction_effect == 'contra'))?$voucher_amount:0;
                                $bank_expense[$office_bank_id] = (($voucher_type_cash_account == 'bank' && $voucher_type_transaction_effect == 'expense') || ($voucher_type_cash_account == 'bank' && $voucher_type_transaction_effect == 'contra'))?$voucher_amount:0;
                                
                                $sum_bank_income[$office_bank_id] = $sum_bank_income[$office_bank_id] + $bank_income[$office_bank_id];
                                $sum_bank_expense[$office_bank_id] = $sum_bank_expense[$office_bank_id] + $bank_expense[$office_bank_id];
                            
                                $running_bank_balance[$office_bank_id] = $month_opening_balance['bank_balance'][$office_bank_id]['amount'] + ($sum_bank_income[$office_bank_id] - $sum_bank_expense[$office_bank_id]);
                            }
                            
                            if($office_cash_id && isset($sum_petty_cash_income[$office_cash_id])){
                                $cash_income[$office_cash_id] = (($voucher_type_cash_account == 'cash' && $voucher_type_transaction_effect == 'income') || ($voucher_type_cash_account=='bank' && $voucher_type_transaction_effect == 'contra'))?$voucher_amount:0;
                                $cash_expense[$office_cash_id] = (($voucher_type_cash_account == 'cash' && $voucher_type_transaction_effect == 'expense') || ($voucher_type_cash_account == 'cash' && $voucher_type_transaction_effect == 'contra'))?$voucher_amount:0;
                                
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
                        <td class='align-right'><?=number_format($running_bank_balance[$office_bank_id] == 0 ? $month_opening_balance['bank_balance'][$office_bank_id]['amount']:$running_bank_balance[$office_bank_id],2);?></td>
                    <?php }?>
                    
                    <?php foreach($month_opening_balance['cash_balance'] as $office_cash_id => $cash_account){?>
                        <td class='align-right'><?=number_format($sum_petty_cash_income[$office_cash_id],2);?></td>
                        <td class='align-right'><?=number_format($sum_petty_cash_expense[$office_cash_id],2);?></td>
                        <td class='align-right'><?=number_format($running_petty_cash_balance[$office_cash_id] == 0?  $month_opening_balance['cash_balance'][$office_cash_id]['amount'] :$running_petty_cash_balance[$office_cash_id],2);?></td>
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

$('.btn_action').on('click',function(){
    
    var has_btn_danger = $(this).hasClass('btn-danger')?true:false;

    if(has_btn_danger){
        $(this).toggleClass('btn-success');
        alert('Cleared completed');
    }else{
        alert('Transaction cannot be uncleared. Use the financial report');
    }
    
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

      $(".btn_reverse").on('click',function(){
        var btn = $(this);
        var voucher_id = btn.data('voucher_id');
        var cnfrm = confirm('Are you sure you want to reverse this voucher?');

        if(cnfrm){
            var url = "<?=base_url();?>Journal/reverse_voucher/"+voucher_id;

            $.get(url,function(response){
                alert(response);
                btn.remove();
                window.location.reload();
            });

        }else{
            alert('Reversal process aborted');
        }

      });

      $('.edit_journal').on('dblclick',function(){
        var parent_td = $(this).closest('td');
        var parent_td_content = parent_td.find('span.cell_content').html();
        var voucher_id = $(this).data('voucher_id');
        var reference_column = $(this).data('reference_column');
        
        
        parent_td.html("<input type='text' data-voucher_id = '"+voucher_id+"' data-reference_column = '"+reference_column+"' class='form-control input_content' value='"+parent_td_content+"' />");

      });

      $(document).on('change','.input_content',function(){
        var voucher_id = $(this).data('voucher_id');
        var content = $(this).val();
        var reference_column = $(this).data('reference_column');
        var data = {'voucher_id':voucher_id,'column':reference_column,'content':content};    
        var url = "<?=base_url();?>Journal/edit_journal_description";

        $.post(url,data,function(response){
            alert(response);
        });
      
      });
</script>