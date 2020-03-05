<style>
.span_label{
    font-weight:bold;
}

</style>

<?php 
//print_r($this->session->hierarchy_offices);
//phpinfo();
extract($result);
?>

<div class="row">
  <div class="col-xs-12">
      <?=Widget_base::load('comment');?>
  </div>
</div>

<div class='row'>
    <div col-xs-12>
        <?php
              if(isset($action_labels['show_label_as_button']) && $action_labels['show_label_as_button']){ 
                if($this->user_model->check_role_has_permissions(ucfirst($this->controller),'update'))
                  {
                    echo Widget_base::load('button',get_phrase('edit'),$this->controller.'/edit/'.$this->id);
                  }

                if($this->user_model->check_role_has_permissions(ucfirst($this->controller),'delete'))
                {
                    echo Widget_base::load('button',get_phrase('delete'),$this->controller.'/delete/'.$this->id);
                }
                  
                  echo Widget_base::load('button',$action_labels['button_label'],$this->controller.'/approve/'.$this->id);
                            
                  if($action_labels['show_decline_button']){
                    echo Widget_base::load('button',get_phrase('decline'),$this->controller.'/decline/'.$this->id);
              
                  }

                }
               ?>  
    </div>
<div>

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

                <div class="row" class='form_rows'>
                    <div onclick="PrintElem('#voucher_print')" class="btn btn-default"><?=get_phrase('print');?></div>
                </div>
                
                <hr/>
                <div id="voucher_print">
                <div class="row" class='form_rows'>
                    <div class="col-xs-4"><span class='span_label'><?=get_phrase('office_name');?>:</span> <?=$header['office_name']?></div>
                                    
                    <div class="col-xs-4"><span class='span_label'><?=get_phrase('voucher_date');?>:</span> <?=$header['voucher_date']?></div>

                    <div class="col-xs-4"><span class='span_label'><?=get_phrase('voucher_number');?>:</span> <?=$header['voucher_number']?></div>
                </div>
                        
                <hr/>
                        
                <div class="row" class='form_rows'>

                    <div class="col-xs-4"><span class='span_label'><?=get_phrase('voucher_type');?>:</span> <?=$header['voucher_type_name']?></div>

                    <div class="col-xs-4"><span class='span_label'><?=get_phrase('bank_account');?>:</span> <?=$header['office_bank']?></div>

                    <div class="col-xs-3"><span class='span_label'><?=get_phrase('cheque_number');?>:</span> <?=$header['voucher_cheque_number']?></div>

                </div>

                <hr/>

                <div class="row" class='form_rows'>
                    <div class="col-xs-12"><span class='span_label'><?=get_phrase('vendor');?>:</span> <?=$header['voucher_vendor']?></div>
                </div>

                <hr/>

                <div class="row" class='form_rows'>
                    <div class="col-xs-12"><span class='span_label'><?=get_phrase('vendor_address');?>:</span> <?=$header['voucher_vendor_address']?></div>
                </div>

                <hr/>

                <div class="row" class='form_rows'>
                    <div class="col-xs-12"><span class='span_label'><?=get_phrase('voucher_description');?>:</span> <?=$header['voucher_description']?></div>
                </div>

                <hr/>

                <div class="row" class='form_rows'>
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
                                    <td  colspan='3'><?=get_phrase('raised_by');?>:<td> <td colspan='3'><?=get_phrase('signature');?>:</td>
                                </tr>
                                <tr>
                                    <td  colspan='3'><?=get_phrase('verified_by');?>:<td> <td colspan='3'><?=get_phrase('signature');?>:</td>
                                </tr>
                                <tr>        
                                    <td  colspan='3'><?=get_phrase('approved_by');?>:<td> <td colspan='3'><?=get_phrase('signature');?>:</td>
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
