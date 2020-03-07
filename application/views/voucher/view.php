<style>
.span_label{
    font-weight:bold;
}

</style>

<?php 

    //print_r($this->voucher_model->get_office_transacting_month(9));

    extract($result);
    $logged_role_id = $this->session->role_id;
    $table = 'voucher';
    $primary_key = hash_id($this->id,'decode');
?>

<div class="row">
  <div class="col-xs-12">
      <?=Widget_base::load('comment');?>
  </div>
</div>


<div class='row'>
    <div class="col-xs-12">
        <div class="panel panel-default" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                       <?php echo get_phrase('transaction_voucher');?>
                </div>
            </div>
                
            <div class="panel-body"  style="max-width:50; overflow: auto;padding-left: 30px;padding-right: 30px;">	

                <div class="row form_rows">
                    <div class='col-xs-12'>
                        <div onclick="PrintElem('#voucher_print')" class="btn btn-default"><?=get_phrase('print');?></div>
                        <?php 
                            echo approval_action_buttons($logged_role_id,$table,$primary_key);
                        ?>
                    </div>
                </div>
                
                <hr/>
                <div id="voucher_print">
                <div class="row form_rows">
                    <div class="col-xs-4"><span class='span_label'><?=get_phrase('office_name');?>:</span> <?=$header['office_name']?></div>
                                    
                    <div class="col-xs-4"><span class='span_label'><?=get_phrase('voucher_date');?>:</span> <?=$header['voucher_date']?></div>

                    <div class="col-xs-4"><span class='span_label'><?=get_phrase('voucher_number');?>:</span> <?=$header['voucher_number']?></div>
                </div>
                        
                <hr/>
                        
                <div class="row form_rows">

                    <div class="col-xs-4"><span class='span_label'><?=get_phrase('voucher_type');?>:</span> <?=$header['voucher_type_name']?></div>

                    <div class="col-xs-4"><span class='span_label'><?=get_phrase('bank_account');?>:</span> <?=$header['office_bank']?></div>

                    <div class="col-xs-3"><span class='span_label'><?=get_phrase('cheque_number');?>:</span> <?=$header['voucher_cheque_number']?></div>

                </div>

                <hr/>

                <div class="row form_rows">
                    <div class="col-xs-12"><span class='span_label'><?=get_phrase('vendor');?>:</span> <?=$header['voucher_vendor']?></div>
                </div>

                <hr/>

                <div class="row form_rows">
                    <div class="col-xs-12"><span class='span_label'><?=get_phrase('vendor_address');?>:</span> <?=$header['voucher_vendor_address']?></div>
                </div>

                <hr/>

                <div class="row form_rows">
                    <div class="col-xs-12"><span class='span_label'><?=get_phrase('voucher_description');?>:</span> <?=$header['voucher_description']?></div>
                </div>

                <hr/>

                <div class="row form_rows">
                   <table class='table table-striped'>
                        <thead>
                            <tr>
                                <th><?=get_phrase('quantity');?></th>
                                <th><?=get_phrase('description');?></th>
                                <th><?=get_phrase('unit_cost');?></th>
                                <th><?=get_phrase('total_cost');?></th>
                                <th><?=get_phrase('account');?></th>
                                <th><?=get_phrase('project_allocation');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($body as $row){?>
                                <tr>
                                    <td><?=number_format($row['quantity'],2)?></td>
                                    <td><?=$row['description']?></td>
                                    <td><?=number_format($row['unitcost'],2)?></td>
                                    <td><?=number_format($row['totalcost'],2)?></td>
                                    <td><?=$row['account_code']?></td>
                                    <td><?=$row['project_allocation_code']?></td>
                                </tr>
                            <?php }?>
                        </tbody>

                        <tfoot>
                                <tr>
                                    <td colspan='3'><?=get_phrase('voucher_total');?></td>
                                    <td colspan='3'><?=number_format(array_sum(array_column($body,'totalcost')),2);?></td>
                                </tr>
                                <tr>
                                    <td  colspan='3'><span style='font-weight:bold;'><?=get_phrase('raised_by');?>:</span> <?=$raiser_approver_info['voucher_raiser_name'];?><td> <td colspan='3'><span style='font-weight:bold;'><?=get_phrase('signature');?>:</span></td>
                                </tr>
                                
                                <tr>        
                                    <td  colspan='3'><span style='font-weight:bold;'><?=get_phrase('approved_by');?>:</span><td> <td colspan='3'><span style='font-weight:bold;'><?=get_phrase('signature');?>:</span></td>
                                </tr>
                        </tfoot>
                   </table>
                </div>

            <div>
            </div>
        </div>
    </div>
</div>   


<script type="text/javascript">

    function PrintElem(elem)
    {
        $(elem).printThis({ 
		    debug: false,              
		    importCSS: true,             
		    importStyle: true,         
		    printContainer: false,       
		    loadCSS: "", 
		    pageTitle: "<?php echo get_phrase('payment_voucher');?>",             
		    removeInline: false,        
		    printDelay: 333,            
		    header: null,             
		    formValues: true          
		});
    }
</script>
