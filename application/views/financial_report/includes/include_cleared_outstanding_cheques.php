<table class="table table-striped tbl_outstanding_cheque_connector" id="tbl_cleared_outstanding_cheque">
           <thead>
                <tr>
                    <th><?=get_phrase('action');?></th>
                    <th><?=get_phrase('date');?></th>
                    <th><?=get_phrase('description');?></th>
                    <th><?=get_phrase('cheque_number');?></th>
                    <th><?=get_phrase('bank_account_name');?></th>
                    <th><?=get_phrase('amount');?></th>
                </tr>
            </thead>
            <tbody>
               <?php foreach($clear_outstanding_cheques as $clear_outstanding_cheque){?>
                    <tr>
                        <?php 
                            $clear_outstanding_cheque_state_color = "danger";
                            //$oustanding_state_disabled = "";
                            $clear_outstanding_cheque_state_clear_class = 'to_clear';
                            $clear_outstanding_cheque_state_label = get_phrase('unclear');
                            if($clear_outstanding_cheque['voucher_cleared'] == 1){
                                $clear_outstanding_cheque_state_color = "success";
                                //$oustanding_state_disabled = "disabled";
                                $oustanding_state_clear_class = '';
                            }
                        ?>
                        <td>
                            <div data-opening_outstanding_cheque_id="<?=isset($outstanding_cheque['opening_outstanding_cheque_id'])?$outstanding_cheque['opening_outstanding_cheque_id']:0;?>" id="<?=$clear_outstanding_cheque['voucher_id'];?>" class='btn btn-<?=$clear_outstanding_cheque_state_color;?> clear_btn <?=$allow_mfr_reconciliation?'':'disabled';?> <?=$clear_outstanding_cheque_state_clear_class;?> cleared_outstanding_cheque cleared_effect state_<?=$clear_outstanding_cheque['voucher_cleared'];?> <?=$clear_outstanding_cheque['voucher_is_reversed']?'hidden':''?>'>
                                <?=$clear_outstanding_cheque_state_label;?>
                            </div>
                        </td>
                        <td><?=$clear_outstanding_cheque['voucher_date'];?></td>
                        <td><?=$clear_outstanding_cheque['voucher_description'];?></td>
                        <td><?=$clear_outstanding_cheque['voucher_cheque_number'];?></td>
                        <td><?=$clear_outstanding_cheque['office_bank_name'];?></td>
                        <td class='td_row_amount'><?=number_format($clear_outstanding_cheque['voucher_detail_total_cost'],2);?></td>
                    </tr>
               <?php }?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan='5'><?=get_phrase('total');?></td>
                    <td class='td_effects_total'><?=number_format(array_sum(array_column($clear_outstanding_cheques,'voucher_detail_total_cost')),2);?></td>
                </tr>
            </tfoot>
        </table>