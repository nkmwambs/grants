<table class="table table-striped tbl_outstanding_cheque_connector" id="tbl_cleared_outstanding_cheque">
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
               <?php foreach($clear_outstanding_cheques as $clear_outstanding_cheque){?>
                    <tr>
                        <?php 
                            $clear_outstanding_cheque_state_color = "danger";
                            //$oustanding_state_disabled = "";
                            $clear_outstanding_cheque_state_clear_class = 'to_clear';
                            $clear_outstanding_cheque_state_label = get_phrase('clear');
                            if($clear_outstanding_cheque['voucher_cleared'] == 1){
                                $clear_outstanding_cheque_state_color = "success";
                                //$oustanding_state_disabled = "disabled";
                                //$oustanding_state_clear_class = '';
                                $clear_outstanding_cheque_state_label = get_phrase('unclear');
                            }
                        ?>
                        <td>
                            <div id="<?=$clear_outstanding_cheque['voucher_id'];?>" class='btn btn-<?=$clear_outstanding_cheque_state_color;?> clear_btn <?=$clear_outstanding_cheque_state_clear_class;?> cleared_outstanding_cheque cleared_effect state_<?=$clear_outstanding_cheque['voucher_cleared'];?>'>
                                <?=$clear_outstanding_cheque_state_label;?>
                            </div>
                        </td>
                        <td><?=$clear_outstanding_cheque['voucher_date'];?></td>
                        <td><?=$clear_outstanding_cheque['voucher_description'];?></td>
                        <td><?=$clear_outstanding_cheque['voucher_cheque_number'];?></td>
                        <td><?=number_format($clear_outstanding_cheque['voucher_detail_total_cost'],2);?></td>
                    </tr>
               <?php }?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan='4'><?=get_phrase('total');?></td>
                    <td><?=number_format(array_sum(array_column($clear_outstanding_cheques,'voucher_detail_total_cost')),2);?></td>
                </tr>
            </tfoot>
        </table>