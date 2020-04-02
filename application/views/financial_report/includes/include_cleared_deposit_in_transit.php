<table class="table table-striped tbl_transit_deposit_connector" id='tbl_cleared_transit_deposit'>
           <thead>
                <tr>
                    <th><?=get_phrase('action');?></th>
                    <th><?=get_phrase('date');?></th>
                    <th><?=get_phrase('description');?></th>
                    <th><?=get_phrase('amount');?></th>
                </tr>
            </thead>
            <tbody>
               <?php foreach($cleared_deposit_in_transit as $cleared_deposit_in_transit_row){?>
                    <tr>
                        <?php 
                            $cleared_deposit_in_transit_state_color = "danger";
                            //$oustanding_state_disabled = "";
                            $cleared_deposit_in_transit_state_clear_class = 'to_clear';
                            $cleared_deposit_in_transit_state_label = get_phrase('clear');
                            if($cleared_deposit_in_transit_row['voucher_cleared'] == 1){
                                $cleared_deposit_in_transit_state_color = "success";
                                //$oustanding_state_disabled = "disabled";
                                //$oustanding_state_clear_class = '';
                                $cleared_deposit_in_transit_state_label = get_phrase('unclear');
                            }
                        ?>
                        <td>
                            <div id="<?=$cleared_deposit_in_transit_row['voucher_id'];?>" class='btn btn-<?=$cleared_deposit_in_transit_state_color;?> <?=$cleared_deposit_in_transit_state_clear_class;?> deposit_in_transit cleared_effect state_<?=$cleared_deposit_in_transit_row['voucher_cleared'];?>'>
                                <?=$cleared_deposit_in_transit_state_label;?>
                            </div>
                        </td>
                        <td><?=$cleared_deposit_in_transit_row['voucher_date'];?></td>
                        <td><?=$cleared_deposit_in_transit_row['voucher_description'];?></td>
                        <td><?=number_format($cleared_deposit_in_transit_row['voucher_detail_total_cost'],2);?></td>
                    </tr>
               <?php }?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan='3'><?=get_phrase('total');?></td>
                    <td><?=number_format(array_sum(array_column($cleared_deposit_in_transit,'voucher_detail_total_cost')),2);?></td>
                </tr>
            </tfoot>
        </table>