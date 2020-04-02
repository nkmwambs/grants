<table class="table table-striped tbl_cleared_transit_deposit_connector" id='tbl_transit_deposit'>
           <thead>
                <tr>
                    <th><?=get_phrase('action');?></th>
                    <th><?=get_phrase('date');?></th>
                    <th><?=get_phrase('description');?></th>
                    <th><?=get_phrase('amount');?></th>
                </tr>
            </thead>
            <tbody>
               <?php foreach($deposit_in_transit as $deposit_in_transit_row){?>
                    <tr>
                        <?php 
                            $deposit_in_transit_state_color = "danger";
                            //$oustanding_state_disabled = "";
                            $deposit_in_transit_state_clear_class = 'to_clear';
                            $deposit_in_transit_state_label = get_phrase('clear');
                            if($deposit_in_transit_row['voucher_cleared'] == 1){
                                $deposit_in_transit_state_color = "success";
                                //$oustanding_state_disabled = "disabled";
                                //$oustanding_state_clear_class = '';
                                $deposit_in_transit_state_label = get_phrase('unclear');
                            }
                        ?>
                        <td>
                            <div id="<?=$deposit_in_transit_row['voucher_id'];?>" class='btn btn-<?=$deposit_in_transit_state_color;?> <?=$deposit_in_transit_state_clear_class;?> deposit_in_transit active_effect state_<?=$deposit_in_transit_row['voucher_cleared'];?>'>
                                <?=$deposit_in_transit_state_label;?>
                            </div>
                        </td>
                        <td><?=$deposit_in_transit_row['voucher_date'];?></td>
                        <td><?=$deposit_in_transit_row['voucher_description'];?></td>
                        <td><?=number_format($deposit_in_transit_row['voucher_detail_total_cost'],2);?></td>
                    </tr>
               <?php }?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan='3'><?=get_phrase('total');?></td>
                    <td><?=number_format(array_sum(array_column($deposit_in_transit,'voucher_detail_total_cost')),2);?></td>
                </tr>
            </tfoot>
    </table>