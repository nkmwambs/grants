
    <table class="table table-striped tbl_cleared_outstanding_cheque_connector" id='tbl_outstanding_cheque'>
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
               <?php foreach($outstanding_cheques as $outstanding_cheque){?>
                    <tr>
                        <?php 
                            $oustanding_state_color = "danger";
                            //$oustanding_state_disabled = "";
                            $oustanding_state_clear_class = 'to_clear';
                            $oustanding_state_label = get_phrase('clear');
                            if($outstanding_cheque['voucher_cleared'] == 1){
                                $oustanding_state_color = "success";
                                //$oustanding_state_disabled = "disabled";
                                //$oustanding_state_clear_class = '';
                                //$oustanding_state_label = get_phrase('unclear');
                            }
                        ?>
                        <td>
                            <div id="<?=$outstanding_cheque['voucher_id'];?>" class='btn btn-<?=$oustanding_state_color;?> clear_btn <?=$oustanding_state_clear_class;?> outstanding_cheque active_effect state_<?=$outstanding_cheque['voucher_cleared'];?>'>
                                <?=$oustanding_state_label;?>
                            </div>
                        </td>
                        <td><?=$outstanding_cheque['voucher_date'];?></td>
                        <td><?=$outstanding_cheque['voucher_description'];?></td>
                        <td><?=$outstanding_cheque['voucher_cheque_number'];?></td>
                        <td class='td_row_amount'><?=number_format($outstanding_cheque['voucher_detail_total_cost'],2);?></td>
                    </tr>
               <?php }?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan='4'><?=get_phrase('total');?></td>
                    <td class='td_effects_total'><?=number_format(array_sum(array_column($outstanding_cheques,'voucher_detail_total_cost')),2);?></td>
                </tr>
            </tfoot>
    </table>